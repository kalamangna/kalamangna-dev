<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                <i class="fa-solid fa-briefcase text-xl"></i>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Projects</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-1"><?= $total_projects; ?></h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="h-12 w-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4">
                <i class="fa-solid fa-spinner text-xl fa-spin"></i>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Active Projects</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-1"><?= $active_projects; ?></h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="h-12 w-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
                <i class="fa-solid fa-circle-check text-xl"></i>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Completed</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-1"><?= $completed_projects; ?></h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="h-12 w-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4">
                <i class="fa-solid fa-users text-xl"></i>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Clients</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-1 text-purple-600"><?= $total_clients; ?></h3>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-800">Recent Projects</h2>
            <a href="<?= base_url('projects'); ?>" class="text-sm font-bold text-blue-600 hover:text-blue-700">View All</a>
        </div>
        <div class="divide-y divide-slate-100">
            <?php foreach($recent_projects as $project): ?>
            <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                <div class="flex items-center space-x-4">
                    <div class="h-10 w-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                        <i class="fa-solid fa-folder"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800"><?= $project['name']; ?></h4>
                        <p class="text-xs text-slate-500"><?= $project['company_name']; ?></p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase border <?= $project['status'] == 'Completed' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-blue-50 text-blue-600 border-blue-100'; ?>">
                        <?= $project['status']; ?>
                    </span>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs"></i>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if(empty($recent_projects)): ?>
                <div class="p-10 text-center text-slate-400 italic">No project data available.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
