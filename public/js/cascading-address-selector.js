/**
 * Advanced Cascading Address Selector (5 Levels)
 * Country → Region → Province → City/Municipality → Barangay
 * Features: Dynamic loading, validation, loading states, complete address requirement
 */

class CascadingAddressSelector {
    constructor(prefix = 'present') {
        this.prefix = prefix;
        const appBase = (window.APP_API_BASE || '').replace(/\/$/, '');
        this.API_BASE = appBase ? `${appBase}/api` : '/api';
        
        // DOM Elements
        this.countrySelect = document.getElementById(`${prefix}_country`);
        this.regionSelect = document.getElementById(`${prefix}_region`);
        this.provinceSelect = document.getElementById(`${prefix}_province`);
        this.citySelect = document.getElementById(`${prefix}_city`);
        this.barangaySelect = document.getElementById(`${prefix}_barangay`);
        
        // Validation elements
        this.addressCompleteMsg = document.getElementById(`${prefix}_address_complete`);
        this.addressIncompleteMsg = document.getElementById(`${prefix}_address_incomplete`);
        
        // Full address display
        this.addressDisplay = document.getElementById(`${prefix}_address_display`);
        
        if (!this.countrySelect) {
            console.warn(`Address selector with prefix "${prefix}" not found`);
            return;
        }
        
        this.init();
    }

    init() {
        this.loadCountries();
        this.attachEventListeners();
        this.restoreValues();
    }

    attachEventListeners() {
        this.countrySelect.addEventListener('change', () => this.onCountryChange());
        if (this.regionSelect) {
            this.regionSelect.addEventListener('change', () => this.onRegionChange());
        }
        if (this.provinceSelect) {
            this.provinceSelect.addEventListener('change', () => this.onProvinceChange());
        }
        if (this.citySelect) {
            this.citySelect.addEventListener('change', () => this.onCityChange());
        }
        if (this.barangaySelect) {
            this.barangaySelect.addEventListener('change', () => this.onBarangayChange());
        }
    }

    loadCountries() {
        this.setSelectState(this.countrySelect, 'loading');
        
        fetch(`${this.API_BASE}/locations/countries`)
            .then(response => {
                if (!response.ok) throw new Error('Failed to load countries');
                return response.json();
            })
            .then(data => {
                this.populateSelect(this.countrySelect, data, 'Select Country');
                this.setSelectState(this.countrySelect, 'ready');
            })
            .catch(error => {
                console.error('Error loading countries:', error);
                this.showError(this.countrySelect, 'Error loading countries');
                this.setSelectState(this.countrySelect, 'error');
            });
    }

    onCountryChange() {
        const countryCode = this.countrySelect.value;
        
        // Clear all subordinate selects
        this.disableAndClearAllBelow('country');
        
        if (!countryCode) {
            this.validateAndDisplayAddress();
            return;
        }
        
        // Only load regions if Philippines is selected
        if (countryCode === 'PH') {
            this.loadRegions();
        } else {
            this.showNotice(this.regionSelect?.parentElement, 'Non-Philippines address: Region and deeper levels not required');
        }
        
        this.validateAndDisplayAddress();
    }

    loadRegions() {
        if (!this.regionSelect) return;
        
        this.setSelectState(this.regionSelect, 'loading');
        
        fetch(`${this.API_BASE}/locations/philippines/regions`)
            .then(response => {
                if (!response.ok) throw new Error('Failed to load regions');
                return response.json();
            })
            .then(data => {
                this.populateSelect(this.regionSelect, data, 'Select Region');
                this.setSelectState(this.regionSelect, 'ready');
                this.regionSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error loading regions:', error);
                this.showError(this.regionSelect, 'Error loading regions');
                this.setSelectState(this.regionSelect, 'error');
            });
    }

    onRegionChange() {
        const regionCode = this.regionSelect.value;
        
        this.disableAndClearAllBelow('region');
        
        if (!regionCode) {
            this.validateAndDisplayAddress();
            return;
        }
        
        this.loadProvinces(regionCode);
        this.validateAndDisplayAddress();
    }

    loadProvinces(regionCode) {
        if (!this.provinceSelect) return;
        
        this.setSelectState(this.provinceSelect, 'loading');
        
        fetch(`${this.API_BASE}/locations/philippines/provinces/${regionCode}`)
            .then(response => {
                if (!response.ok) throw new Error('Failed to load provinces');
                return response.json();
            })
            .then(data => {
                this.populateSelect(this.provinceSelect, data, 'Select Province');
                this.setSelectState(this.provinceSelect, 'ready');
                this.provinceSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error loading provinces:', error);
                this.showError(this.provinceSelect, 'Error loading provinces');
                this.setSelectState(this.provinceSelect, 'error');
            });
    }

    onProvinceChange() {
        const provinceCode = this.provinceSelect.value;
        
        this.disableAndClearAllBelow('province');
        
        if (!provinceCode) {
            this.validateAndDisplayAddress();
            return;
        }
        
        this.loadCities(provinceCode);
        this.validateAndDisplayAddress();
    }

    loadCities(provinceCode) {
        if (!this.citySelect) return;
        
        this.setSelectState(this.citySelect, 'loading');
        
        fetch(`${this.API_BASE}/locations/cities/${provinceCode}`)
            .then(response => {
                if (!response.ok) throw new Error('Failed to load cities');
                return response.json();
            })
            .then(data => {
                this.populateSelect(this.citySelect, data, 'Select City/Municipality');
                this.setSelectState(this.citySelect, 'ready');
                this.citySelect.disabled = false;
            })
            .catch(error => {
                console.error('Error loading cities:', error);
                this.showError(this.citySelect, 'Error loading cities');
                this.setSelectState(this.citySelect, 'error');
            });
    }

    onCityChange() {
        const cityCode = this.citySelect.value;
        
        this.disableAndClearAllBelow('city');
        
        if (!cityCode) {
            this.validateAndDisplayAddress();
            return;
        }
        
        this.loadBarangays(cityCode);
        this.validateAndDisplayAddress();
    }

    loadBarangays(cityCode) {
        if (!this.barangaySelect) return;
        
        this.setSelectState(this.barangaySelect, 'loading');
        
        fetch(`${this.API_BASE}/locations/barangays/${cityCode}`)
            .then(response => {
                if (!response.ok) throw new Error('Failed to load barangays');
                return response.json();
            })
            .then(data => {
                this.populateSelect(this.barangaySelect, data, 'Select Barangay');
                this.setSelectState(this.barangaySelect, 'ready');
                this.barangaySelect.disabled = false;
            })
            .catch(error => {
                console.error('Error loading barangays:', error);
                this.showError(this.barangaySelect, 'Error loading barangays');
                this.setSelectState(this.barangaySelect, 'error');
            });
    }

    onBarangayChange() {
        const barangayCode = this.barangaySelect.value;
        
        this.disableAndClearAllBelow('barangay');
        
        this.validateAndDisplayAddress();
    }

    populateSelect(select, items, placeholder) {
        select.innerHTML = `<option value="">${placeholder}</option>`;
        
        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item.code || item.id;
            option.textContent = item.name;
            select.appendChild(option);
        });
    }

    disableAndClearAllBelow(level) {
        const levelsOrder = ['country', 'region', 'province', 'city', 'barangay'];
        const currentIndex = levelsOrder.indexOf(level);
        
        if (currentIndex === -1) return;
        
        // Clear and disable all selects below this level
        for (let i = currentIndex + 1; i < levelsOrder.length; i++) {
            const selectId = `${this.prefix}_${levelsOrder[i]}`;
            const selectEl = document.getElementById(selectId);
            
            if (selectEl) {
                selectEl.innerHTML = '<option value="">Select</option>';
                selectEl.value = '';
                selectEl.disabled = true;
                this.setSelectState(selectEl, 'disabled');
            }
        }
        
        // Remove error messages
        this.clearErrors();
    }

    setSelectState(select, state) {
        select.className = select.className.replace(/\b(is-loading|is-error|is-disabled|is-ready)\b/g, '');
        
        if (state === 'loading') {
            select.classList.add('is-loading');
            select.disabled = true;
        } else if (state === 'error') {
            select.classList.add('is-error');
            select.disabled = true;
        } else if (state === 'disabled') {
            select.classList.add('is-disabled');
            select.disabled = true;
        } else if (state === 'ready') {
            select.classList.add('is-ready');
            select.disabled = false;
        }
    }

    showError(targetElement, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger alert-sm mt-1';
        errorDiv.textContent = message;
        
        const existing = targetElement?.parentElement?.querySelector('.alert-danger');
        if (existing) existing.remove();
        
        targetElement?.parentElement?.appendChild(errorDiv);
    }

    showNotice(targetElement, message) {
        const noticeDiv = document.createElement('div');
        noticeDiv.className = 'alert alert-info alert-sm mt-1';
        noticeDiv.textContent = message;
        
        const existing = targetElement?.querySelector('.alert-info');
        if (existing) existing.remove();
        
        targetElement?.appendChild(noticeDiv);
    }

    clearErrors() {
        const errors = document.querySelectorAll(`[id*="${this.prefix}"] ~ .alert-danger`);
        errors.forEach(err => err.remove());
    }

    getAddressData() {
        return {
            country: this.countrySelect?.value || '',
            countryName: this.countrySelect?.selectedOptions[0]?.textContent || '',
            region: this.regionSelect?.value || '',
            regionName: this.regionSelect?.selectedOptions[0]?.textContent || '',
            province: this.provinceSelect?.value || '',
            provinceName: this.provinceSelect?.selectedOptions[0]?.textContent || '',
            city: this.citySelect?.value || '',
            cityName: this.citySelect?.selectedOptions[0]?.textContent || '',
            barangay: this.barangaySelect?.value || '',
            barangayName: this.barangaySelect?.selectedOptions[0]?.textContent || '',
        };
    }

    isAddressComplete() {
        const data = this.getAddressData();
        
        if (!data.country) return false;
        
        // For Philippines, all levels must be filled
        if (data.countryName === 'Philippines') {
            return !!(data.region && data.province && data.city && data.barangay);
        }
        
        // For other countries, only country is required
        return true;
    }

    formatFullAddress() {
        const data = this.getAddressData();
        
        if (!data.country) return '';
        
        if (data.countryName === 'Philippines') {
            return [
                `Barangay ${data.barangayName}`,
                data.cityName,
                data.provinceName,
                data.regionName,
                'Philippines'
            ].filter(Boolean).join(', ');
        }
        
        return data.countryName;
    }

    validateAndDisplayAddress() {
        const isComplete = this.isAddressComplete();
        const fullAddress = this.formatFullAddress();
        
        // Update display
        if (this.addressDisplay) {
            if (isComplete && fullAddress) {
                this.addressDisplay.textContent = `📍 ${fullAddress}`;
                this.addressDisplay.className = 'address-display complete';
            } else {
                this.addressDisplay.textContent = '📍 Incomplete address';
                this.addressDisplay.className = 'address-display incomplete';
            }
        }
        
        // Update validation messages
        if (this.addressCompleteMsg) {
            this.addressCompleteMsg.style.display = isComplete ? 'block' : 'none';
        }
        if (this.addressIncompleteMsg) {
            this.addressIncompleteMsg.style.display = !isComplete ? 'block' : 'none';
        }
        
        // Update form validation state
        this.updateFormValidationState(isComplete);
    }

    updateFormValidationState(isComplete) {
        // Find the submit button
        const form = this.countrySelect?.closest('form');
        if (!form) return;
        
        const submitBtn = form.querySelector('button[type="submit"]');
        if (!submitBtn) return;
        
        if (isComplete) {
            submitBtn.classList.remove('disabled');
            submitBtn.disabled = false;
        } else {
            submitBtn.classList.add('disabled');
            submitBtn.disabled = true;
        }
    }

    restoreValues() {
        // If there are data attributes with saved values, restore them
        const savedCountry = this.countrySelect?.dataset.selected;
        if (savedCountry) {
            this.countrySelect.value = savedCountry;
            this.onCountryChange();
        }
    }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    new CascadingAddressSelector('present');
    new CascadingAddressSelector('permanent');
});

// Export for manual use
window.CascadingAddressSelector = CascadingAddressSelector;
