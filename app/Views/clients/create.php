<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <nav class="flex text-sm text-slate-500 mb-2">
            <a href="<?= base_url('clients'); ?>" class="hover:text-blue-600 transition-colors">Clients</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 font-medium">New Client</span>
        </nav>
        <h2 class="text-2xl font-bold text-slate-800">Add New Client</h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="<?= base_url('clients'); ?>" method="POST" class="p-8 space-y-6">
            <?= csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Info -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Company Name</label>
                    <input type="text" name="company_name" value="<?= old('company_name'); ?>" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Contact Person Name</label>
                    <input type="text" name="name" value="<?= old('name'); ?>" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Phone Number</label>
                    <input type="text" name="phone" value="<?= old('phone'); ?>"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                </div>

                <!-- Region Selection -->
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Province</label>
                    <div class="relative">
                        <select id="province_select" name="province_id" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all appearance-none">
                            <option value="">Loading provinces...</option>
                        </select>
                        <input type="hidden" id="province_name" name="province_name">
                        <div id="province_loader" class="absolute right-4 top-3 hidden">
                            <i class="fa-solid fa-spinner fa-spin text-blue-500"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">City / Regency</label>
                    <div class="relative">
                        <select id="city_select" name="city_id" required disabled
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all appearance-none disabled:bg-slate-100 disabled:cursor-not-allowed">
                            <option value="">Select province first</option>
                        </select>
                        <input type="hidden" id="city_name" name="city_name">
                        <div id="city_loader" class="absolute right-4 top-3 hidden">
                            <i class="fa-solid fa-spinner fa-spin text-blue-500"></i>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Address Detail (Street, Building, etc)</label>
                    <textarea name="address_detail" rows="3" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all"
                        placeholder="Jl. Merdeka No. 123..."><?= old('address_detail'); ?></textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end space-x-3">
                <a href="<?= base_url('clients'); ?>" class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95">
                    Save Client
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const provinceSelect = document.getElementById('province_select');
    const citySelect = document.getElementById('city_select');
    const provinceNameInput = document.getElementById('province_name');
    const cityNameInput = document.getElementById('city_name');
    const provinceLoader = document.getElementById('province_loader');
    const cityLoader = document.getElementById('city_loader');

    // Fetch Provinces
    async function fetchProvinces() {
        provinceLoader.classList.remove('hidden');
        try {
            const response = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            const data = await response.json();
            
            provinceSelect.innerHTML = '<option value="">Select Province</option>';
            data.forEach(prov => {
                const option = document.createElement('option');
                option.value = prov.id;
                option.textContent = prov.name;
                provinceSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching provinces:', error);
            provinceSelect.innerHTML = '<option value="">Error loading data</option>';
        } finally {
            provinceLoader.classList.add('hidden');
        }
    }

    // Fetch Cities
    async function fetchCities(provinceId) {
        citySelect.disabled = true;
        cityLoader.classList.remove('hidden');
        citySelect.innerHTML = '<option value="">Loading cities...</option>';
        
        try {
            const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`);
            const data = await response.json();
            
            citySelect.innerHTML = '<option value="">Select City</option>';
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
            citySelect.disabled = false;
        } catch (error) {
            console.error('Error fetching cities:', error);
            citySelect.innerHTML = '<option value="">Error loading data</option>';
        } finally {
            cityLoader.classList.add('hidden');
        }
    }

    // Handle Province Change
    provinceSelect.addEventListener('change', function() {
        const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
        provinceNameInput.value = selectedOption.textContent;
        
        if (this.value) {
            fetchCities(this.value);
        } else {
            citySelect.innerHTML = '<option value="">Select province first</option>';
            citySelect.disabled = true;
            provinceNameInput.value = '';
        }
        cityNameInput.value = '';
    });

    // Handle City Change
    citySelect.addEventListener('change', function() {
        const selectedOption = citySelect.options[citySelect.selectedIndex];
        cityNameInput.value = selectedOption.textContent;
    });

    fetchProvinces();
});
</script>
<?= $this->endSection(); ?>
