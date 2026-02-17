<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Clients</h2>
            <p class="text-slate-500 text-sm">Manage your client companies and their Indonesian regional locations.</p>
        </div>
        <a href="<?= base_url('clients/new'); ?>" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 transition-all">
            <i class="fa-solid fa-plus mr-2"></i> New Client
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Company & Contact</th>
                        <th class="px-6 py-4">Location (City, Province)</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if(empty($clients)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">No clients found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($clients as $client): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800 block"><?= $client['company_name']; ?></span>
                                <span class="text-xs text-slate-500"><?= $client['name']; ?></span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center text-slate-600">
                                    <i class="fa-solid fa-location-dot text-slate-300 mr-2"></i>
                                    <span><?= $client['city_name'] ?? '-'; ?>, <?= $client['province_name'] ?? '-'; ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <?= $client['phone'] ?: '-'; ?>
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <a href="<?= base_url('clients/'.$client['id']); ?>" class="text-slate-400 hover:text-blue-600 transition-colors" title="View Details">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="<?= base_url('clients/'.$client['id'].'/edit'); ?>" class="text-slate-400 hover:text-amber-600 transition-colors" title="Edit Client">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="<?= base_url('clients/'.$client['id']); ?>" method="POST" class="inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="text-slate-300 hover:text-red-600 transition-colors" title="Delete Client" onclick="return confirm('Are you sure you want to delete this client?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
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
