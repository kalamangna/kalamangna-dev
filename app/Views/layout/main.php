<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Project Management System'; ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col flex-shrink-0">
            <div class="h-16 flex items-center px-6 border-b border-slate-200">
                <span class="text-xl font-bold text-blue-600">PM SYSTEM</span>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="<?= base_url('dashboard'); ?>" class="flex items-center space-x-3 px-4 py-2.5 <?= uri_string() == 'dashboard' ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50'; ?> rounded-xl font-medium transition-all">
                    <i class="fa-solid fa-chart-line w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= base_url('clients'); ?>" class="flex items-center space-x-3 px-4 py-2.5 <?= strpos(uri_string(), 'clients') !== false ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50'; ?> rounded-xl font-medium transition-all">
                    <i class="fa-solid fa-users w-5 text-center"></i>
                    <span>Clients</span>
                </a>
                <a href="<?= base_url('projects'); ?>" class="flex items-center space-x-3 px-4 py-2.5 <?= strpos(uri_string(), 'projects') !== false ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50'; ?> rounded-xl font-medium transition-all">
                    <i class="fa-solid fa-folder-tree w-5 text-center"></i>
                    <span>Projects</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-200">
                <a href="<?= base_url('logout'); ?>" class="flex items-center space-x-3 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl font-medium transition-all">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 flex-shrink-0">
                <h1 class="text-lg font-semibold text-slate-800"><?= $title; ?></h1>
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-slate-800 leading-none"><?= session()->get('name'); ?></p>
                        <p class="text-xs text-slate-500 mt-1"><?= session()->get('role'); ?></p>
                    </div>
                    <div class="h-9 w-9 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                        <?= substr(session()->get('name'), 0, 1); ?>
                    </div>
                </div>
            </header>
            <main class="flex-1 overflow-y-auto p-6">
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                
                <?= $this->renderSection('content'); ?>
            </main>
        </div>
    </div>
</body>
</html>