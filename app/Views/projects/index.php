<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Projects</h2>
            <p class="text-slate-500 text-sm">List of all your ongoing and completed projects.</p>
        </div>
        <a href="<?= base_url('projects/new'); ?>" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 transition-all">
            <i class="fa-solid fa-plus mr-2"></i> New Project
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Project Name</th>
                        <th class="px-6 py-4">Client / Company</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Deadline</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if(empty($projects)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-400 italic">No projects found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($projects as $project): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-800 block"><?= $project['name']; ?></span>
                                <span class="text-xs text-slate-400"><?= date('d M Y', strtotime($project['start_date'])); ?></span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                <?= $project['company_name']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php 
                                    $statusColor = match($project['status']) {
                                        'Completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'On Progress' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        default => 'bg-slate-50 text-slate-700 border-slate-100',
                                    };
                                ?>
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold border <?= $statusColor; ?>">
                                    <?= $project['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <?= date('d M Y', strtotime($project['end_date'])); ?>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="<?= base_url('projects/'.$project['id']); ?>" class="text-slate-400 hover:text-blue-600"><i class="fa-solid fa-eye"></i></a>
                                <a href="<?= base_url('projects/'.$project['id'].'/edit'); ?>" class="text-slate-400 hover:text-amber-600"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>