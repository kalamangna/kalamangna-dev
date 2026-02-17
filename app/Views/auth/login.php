<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PM System</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-blue-600">PM SYSTEM</h1>
            <p class="text-slate-500 mt-2">Sign in to manage your projects</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-blue-900/5 border border-slate-100">
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="mb-6 p-4 bg-red-50 text-red-700 text-sm rounded-xl border border-red-100">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login'); ?>" method="POST" class="space-y-6">
                <?= csrf_field(); ?>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all"
                        placeholder="name@company.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all"
                        placeholder="••••••••">
                </div>
                <button type="submit"
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98]">
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center text-slate-400 text-xs mt-8">
            &copy; 2026 PM System. All rights reserved.
        </p>
    </div>
</body>

</html>