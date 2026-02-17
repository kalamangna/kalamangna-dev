<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <nav class="flex text-sm text-slate-500 mb-2">
            <a href="<?= base_url('projects'); ?>" class="hover:text-blue-600 transition-colors">Projects</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 font-medium">Edit Project</span>
        </nav>
        <h2 class="text-2xl font-bold text-slate-800">Edit Project: <?= $project['name']; ?></h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="<?= base_url('projects/'.$project['id']); ?>" method="POST" class="p-8 space-y-6">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">

            <div class="space-y-6">
                <!-- Project Name -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Project Name</label>
                    <input type="text" name="name" value="<?= old('name', $project['name']); ?>" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                </div>

                <!-- Client Selection -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Client / Institution</label>
                    <select name="client_id" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                        <?php foreach($clients as $client): ?>
                            <option value="<?= $client['id']; ?>" <?= old('client_id', $project['client_id']) == $client['id'] ? 'selected' : ''; ?>>
                                <?= $client['company_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Start Date</label>
                        <input type="date" name="start_date" value="<?= old('start_date', $project['start_date']); ?>" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">End Date (Deadline)</label>
                        <input type="date" name="end_date" value="<?= old('end_date', $project['end_date']); ?>" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                        <option value="Planning" <?= old('status', $project['status']) == 'Planning' ? 'selected' : ''; ?>>Planning</option>
                        <option value="On Progress" <?= old('status', $project['status']) == 'On Progress' ? 'selected' : ''; ?>>On Progress</option>
                        <option value="Completed" <?= old('status', $project['status']) == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end space-x-3">
                <a href="<?= base_url('projects/'.$project['id']); ?>" class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95">
                    Update Project
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>