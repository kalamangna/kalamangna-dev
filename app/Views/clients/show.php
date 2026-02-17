<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('clients'); ?>" class="h-10 w-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-400 hover:text-blue-600 transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-slate-800"><?= $client['company_name']; ?></h2>
                <p class="text-slate-500 text-sm">Client Details & Region Info</p>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="<?= base_url('clients/'.$client['id'].'/edit'); ?>" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition-all">
                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Client
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Client Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Contact Information</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-slate-400 mb-1">Contact Person</p>
                        <p class="text-slate-800 font-medium"><?= $client['name']; ?></p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 mb-1">Phone Number</p>
                        <p class="text-slate-800 font-medium"><?= $client['phone'] ?: '-'; ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Location Address</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-slate-400 mb-1">Full Address</p>
                        <p class="text-slate-800 font-medium leading-relaxed">
                            <?= $client['address_detail']; ?>,<br>
                            <?= $client['city_name']; ?>, <?= $client['province_name']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Projects -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-200 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-800">Projects History</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-[10px] tracking-widest">
                            <tr>
                                <th class="px-6 py-4">Project Name</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Deadline</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if(empty($projects)): ?>
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-slate-400 italic">No projects recorded for this client.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($projects as $project): ?>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <a href="<?= base_url('projects/'.$project['id']); ?>" class="font-semibold text-slate-800 hover:text-blue-600 transition-colors">
                                            <?= $project['name']; ?>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border <?= $project['status'] == 'Completed' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-blue-50 text-blue-600 border-blue-100'; ?>">
                                            <?= strtoupper($project['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-slate-500">
                                        <?= date('d M Y', strtotime($project['end_date'])); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
