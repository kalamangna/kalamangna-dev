<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('projects'); ?>" class="h-10 w-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-400 hover:text-blue-600 transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-slate-800"><?= $project['name']; ?></h2>
                <p class="text-slate-500 text-sm"><?= $project['company_name']; ?></p>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="<?= base_url('projects/'.$project['id'].'/edit'); ?>" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition-all">
                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Project
            </a>
            <form action="<?= base_url('projects/'.$project['id']); ?>" method="POST" class="inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="px-5 py-2.5 bg-red-50 text-red-600 text-sm font-bold rounded-xl hover:bg-red-100 transition-all" onclick="return confirm('Delete this project?')">
                    <i class="fa-solid fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Project Stats & Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-6">Project Overview</h3>
                
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase font-bold mb-1">Status</p>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold border <?= $project['status'] == 'Completed' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-blue-50 text-blue-700 border-blue-100'; ?>">
                            <?= strtoupper($project['status']); ?>
                        </span>
                    </div>

                    <div class="pt-4 border-t border-slate-50">
                        <p class="text-[10px] text-slate-400 uppercase font-bold mb-1">Project Duration</p>
                        <div class="flex items-center text-sm font-medium text-slate-800">
                            <i class="fa-regular fa-calendar-days mr-2 text-slate-400"></i>
                            <?= date('d M Y', strtotime($project['start_date'])); ?> - <?= date('d M Y', strtotime($project['end_date'])); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Info Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 mb-6">Client Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold mb-2 tracking-widest">Institution Name</p>
                        <p class="text-slate-800 font-semibold"><?= $project['company_name']; ?></p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold mb-2 tracking-widest">Contact Person</p>
                        <p class="text-slate-800 font-semibold"><?= $project['client_contact']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
