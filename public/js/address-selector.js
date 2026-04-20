/**
 * Address Selector - Cascading Dropdowns
 * Handles country selection and Philippine address hierarchy
 */

(function() {
    'use strict';

    class AddressSelector {
        constructor(prefix = 'present') {
            this.prefix = prefix;
            this.countrySelect = document.getElementById(`${prefix}_country`);
            this.regionSelect = document.getElementById(`${prefix}_region`);
            this.provinceSelect = document.getElementById(`${prefix}_province`);
            this.citySelect = document.getElementById(`${prefix}_city`);
            this.barangaySelect = document.getElementById(`${prefix}_barangay`);

            if (!this.countrySelect) return;

            this.init();
        }

        init() {
            this.loadCountries();
            
            // Event listeners
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

            // Restore values if form was resubmitted with errors
            if (this.countrySelect.dataset.selected) {
                this.countrySelect.value = this.countrySelect.dataset.selected;
                this.onCountryChange();
            }
        }

        loadCountries() {
            // Show loading state
            this.countrySelect.innerHTML = '<option value="">Loading countries...</option>';

            fetch('/api/locations/countries')
                .then(response => response.json())
                .then(data => {
                    this.renderCountries(data);
                    // Trigger change event if there's a pre-selected value
                    if (this.countrySelect.dataset.selected) {
                        this.onCountryChange();
                    }
                })
                .catch(error => {
                    console.error('Error loading countries:', error);
                    this.countrySelect.innerHTML = '<option value="">Error loading countries</option>';
                });
        }

        renderCountries(countries) {
            let html = '<option value="">Select Country</option>';
            countries.forEach(country => {
                const selected = this.countrySelect.value === country.code ? 'selected' : '';
                html += `<option value="${country.code}" ${selected}>${country.name}</option>`;
            });
            this.countrySelect.innerHTML = html;
        }

        onCountryChange() {
            const countryCode = this.countrySelect.value;
            
            // Reset dependent selects
            this.resetSelects([this.regionSelect, this.provinceSelect, this.citySelect, this.barangaySelect]);

            if (!countryCode) {
                this.disableSelects([this.regionSelect, this.provinceSelect, this.citySelect, this.barangaySelect]);
                return;
            }

            // If Philippines is selected, load regions
            if (countryCode === 'PH') {
                this.loadPhilippinesRegions();
            } else {
                // For other countries, disable region/province/city/barangay
                this.disableSelects([this.regionSelect, this.provinceSelect, this.citySelect, this.barangaySelect]);
            }
        }

        loadPhilippinesRegions() {
            if (!this.regionSelect) return;

            this.regionSelect.innerHTML = '<option value="">Loading regions...</option>';
            this.regionSelect.disabled = false;

            fetch('/api/locations/philippines/regions')
                .then(response => response.json())
                .then(data => {
                    this.renderRegions(data);
                    // Restore value if form was resubmitted
                    if (this.regionSelect.dataset.selected) {
                        this.regionSelect.value = this.regionSelect.dataset.selected;
                        this.onRegionChange();
                    }
                })
                .catch(error => {
                    console.error('Error loading regions:', error);
                    this.regionSelect.innerHTML = '<option value="">Error loading regions</option>';
                });
        }

        renderRegions(regions) {
            let html = '<option value="">Select Region</option>';
            regions.forEach(region => {
                const selected = this.regionSelect.value === region.code ? 'selected' : '';
                html += `<option value="${region.code}" ${selected}>${region.name}</option>`;
            });
            this.regionSelect.innerHTML = html;
        }

        onRegionChange() {
            const regionCode = this.regionSelect.value;
            
            // Reset dependent selects
            this.resetSelects([this.provinceSelect, this.citySelect, this.barangaySelect]);

            if (!regionCode) {
                this.disableSelects([this.provinceSelect, this.citySelect, this.barangaySelect]);
                return;
            }

            this.loadProvinces(regionCode);
        }

        loadProvinces(regionCode) {
            if (!this.provinceSelect) return;

            this.provinceSelect.innerHTML = '<option value="">Loading provinces...</option>';
            this.provinceSelect.disabled = false;

            fetch(`/api/locations/philippines/provinces/${regionCode}`)
                .then(response => response.json())
                .then(data => {
                    this.renderProvinces(data);
                    // Restore value if form was resubmitted
                    if (this.provinceSelect.dataset.selected) {
                        this.provinceSelect.value = this.provinceSelect.dataset.selected;
                        this.onProvinceChange();
                    }
                })
                .catch(error => {
                    console.error('Error loading provinces:', error);
                    this.provinceSelect.innerHTML = '<option value="">Error loading provinces</option>';
                });
        }

        renderProvinces(provinces) {
            let html = '<option value="">Select Province</option>';
            provinces.forEach(province => {
                const selected = this.provinceSelect.value === province.code ? 'selected' : '';
                html += `<option value="${province.code}" ${selected}>${province.name}</option>`;
            });
            this.provinceSelect.innerHTML = html;
        }

        onProvinceChange() {
            const provinceCode = this.provinceSelect.value;
            
            // Reset dependent selects
            this.resetSelects([this.citySelect, this.barangaySelect]);

            if (!provinceCode) {
                this.disableSelects([this.citySelect, this.barangaySelect]);
                return;
            }

            // For now, just disable city and barangay as per current API
            this.disableSelects([this.citySelect, this.barangaySelect]);
        }

        onCityChange() {
            const cityCode = this.citySelect.value;
            
            // Reset barangay
            this.resetSelects([this.barangaySelect]);

            if (!cityCode) {
                this.disableSelects([this.barangaySelect]);
                return;
            }

            // Load barangays if available
            // this.loadBarangays(cityCode);
        }

        resetSelects(selects) {
            selects.forEach(select => {
                if (select) {
                    select.innerHTML = '<option value="">Select</option>';
                    select.value = '';
                }
            });
        }

        disableSelects(selects) {
            selects.forEach(select => {
                if (select) {
                    select.disabled = true;
                    select.value = '';
                }
            });
        }
    }

    // Initialize address selectors when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            new AddressSelector('present');
            new AddressSelector('permanent');
        });
    } else {
        new AddressSelector('present');
        new AddressSelector('permanent');
    }

    // Export for manual initialization if needed
    window.AddressSelector = AddressSelector;
})();
