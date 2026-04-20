

<?php $__env->startSection('title', 'Edit Profile - MPSU Alumni Network'); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/cascading-address-selector.css')); ?>">
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="mb-0"><i class="fas fa-user-edit"></i> Edit Your Profile</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('alumni.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Contact -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone" name="phone" value="<?php echo e($profile->phone ?? ''); ?>">
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Alumni Personal Information -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="family_name" class="form-label">Family Name</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['family_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="family_name" name="family_name" value="<?php echo e($profile->family_name ?? ''); ?>" required>
                                <?php $__errorArgs = ['family_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="given_name" class="form-label">Given Name</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['given_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="given_name" name="given_name" value="<?php echo e($profile->given_name ?? ''); ?>" required>
                                <?php $__errorArgs = ['given_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="middle_initial" class="form-label">MI</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['middle_initial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="middle_initial" name="middle_initial" value="<?php echo e($profile->middle_initial ?? ''); ?>">
                                <?php $__errorArgs = ['middle_initial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="suffix" class="form-label">Suffix</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['suffix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="suffix" name="suffix" value="<?php echo e($profile->suffix ?? ''); ?>">
                                <?php $__errorArgs = ['suffix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="sex" class="form-label">Sex</label>
                                <select class="form-select <?php $__errorArgs = ['sex'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="sex" name="sex">
                                    <option value="">Select</option>
                                    <option value="Male" <?php echo e($profile->sex === 'Male' ? 'selected' : ''); ?>>Male</option>
                                    <option value="Female" <?php echo e($profile->sex === 'Female' ? 'selected' : ''); ?>>Female</option>
                                </select>
                                <?php $__errorArgs = ['sex'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="date_of_birth" class="form-label">Birthdate (optional)</label>
                                <input type="date" class="form-control <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="date_of_birth" name="date_of_birth" value="<?php echo e($profile->date_of_birth ?? ''); ?>">
                                <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="year_graduated" class="form-label">Year Graduated</label>
                                <input type="number" class="form-control <?php $__errorArgs = ['year_graduated'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="year_graduated" name="year_graduated" placeholder="YYYY" value="<?php echo e($profile->year_graduated ?? ''); ?>" min="1950" max="<?php echo e(date('Y')); ?>">
                                <?php $__errorArgs = ['year_graduated'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="course" class="form-label">Course/Degree</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="course" name="course" value="<?php echo e($profile->course ?? ''); ?>">
                                <?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Premium Profile Picture Section -->
                        <div class="mb-4">
                            <div class="card" style="border: 2px dashed #d4af37; border-radius: 16px; background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, rgba(212, 175, 55, 0.02) 100%);">
                                <div class="card-body p-4">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-camera-alt" style="font-size: 2.5rem; color: #d4af37;"></i>
                                        <h5 class="mt-2 mb-1" style="color: var(--primary-color);">Profile Picture</h5>
                                        <p class="text-muted small">Upload a clear photo to confirm your identity</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="profile_picture" class="form-label" style="font-weight: 600; color: var(--primary-color);">Select Photo</label>
                                        <input type="file" class="form-control <?php $__errorArgs = ['profile_picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="profile_picture" name="profile_picture" accept="image/*" style="padding: 12px; border: 1px solid #d4af37;">
                                        <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> File size limit: 5MB | Supported formats: JPG, PNG, GIF</small>
                                        <?php $__errorArgs = ['profile_picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    <?php if($profile->profile_picture): ?>
                                        <div class="text-center" style="border-top: 1px solid rgba(212, 175, 55, 0.3); padding-top: 15px;">
                                            <p class="small text-muted mb-2">Current Photo</p>
                                            <div style="display: inline-block; padding: 8px; border-radius: 12px; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                <img src="<?php echo e(asset('storage/' . $profile->profile_picture)); ?>" alt="Profile" style="max-width: 120px; height: auto; border-radius: 8px;">
                                            </div>
                                            <div class="form-check mt-3 text-center">
                                                <input class="form-check-input" type="checkbox" id="remove_profile_picture" name="remove_profile_picture" value="1">
                                                <label class="form-check-label" for="remove_profile_picture" style="color: #dc3545;">
                                                    Delete current photo
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Present Address - 6-level cascading selector -->
                        <div class="address-selector-section">
                            <h5><i class="fas fa-map-marker-alt"></i> Present Address (Complete Address Required)</h5>
                            <div id="present_address_display" class="address-display incomplete">📍 Incomplete address</div>
                            
                            <!-- Address Hierarchy Row 1: Country -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_country" class="form-label">
                                        Country
                                        <span class="required">★</span>
                                    </label>
                                    <select class="form-select is-disabled <?php $__errorArgs = ['present_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="present_country" name="present_country" data-selected="<?php echo e($profile->present_country ?? ''); ?>">
                                        <option value="">-- Select Country --</option>
                                    </select>
                                    <div class="invalid-feedback d-block" style="display: none;"></div>
                                    <small class="hierarchy-indicator">Level 1 of 5 • Required for all</small>
                                </div>
                            </div>

                            <!-- Address Hierarchy Row 2: Region -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_region" class="form-label">
                                        Region
                                        <span class="required">★</span>
                                    </label>
                                    <select class="form-select is-disabled <?php $__errorArgs = ['present_region'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="present_region" name="present_region" data-selected="<?php echo e($profile->present_region ?? ''); ?>" disabled>
                                        <option value="">-- Select Region --</option>
                                    </select>
                                    <div class="invalid-feedback d-block" style="display: none;"></div>
                                    <small class="hierarchy-indicator">Level 2 of 5 • Required for Philippines</small>
                                </div>
                            </div>

                            <!-- Address Hierarchy Row 3: Province -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_province" class="form-label">
                                        Province
                                        <span class="required">★</span>
                                    </label>
                                    <select class="form-select is-disabled <?php $__errorArgs = ['present_province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="present_province" name="present_province" data-selected="<?php echo e($profile->present_province ?? ''); ?>" disabled>
                                        <option value="">-- Select Province --</option>
                                    </select>
                                    <div class="invalid-feedback d-block" style="display: none;"></div>
                                    <small class="hierarchy-indicator">Level 3 of 5 • Required for Philippines</small>
                                </div>
                            </div>

                            <!-- Address Hierarchy Row 4: City/Municipality -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_city" class="form-label">
                                        City/Municipality
                                        <span class="required">★</span>
                                    </label>
                                    <select class="form-select is-disabled <?php $__errorArgs = ['present_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="present_city" name="present_city" data-selected="<?php echo e($profile->present_city ?? ''); ?>" disabled>
                                        <option value="">-- Select City/Municipality --</option>
                                    </select>
                                    <div class="invalid-feedback d-block" style="display: none;"></div>
                                    <small class="hierarchy-indicator">Level 4 of 5 • Required for Philippines</small>
                                </div>
                            </div>

                            <!-- Address Hierarchy Row 5: Barangay -->
                            <div class="address-hierarchy-row">
                                <div class="address-field-group">
                                    <label for="present_barangay" class="form-label">
                                        Barangay
                                        <span class="required">★</span>
                                    </label>
                                    <select class="form-select is-disabled <?php $__errorArgs = ['present_barangay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="present_barangay" name="present_barangay" data-selected="<?php echo e($profile->present_barangay ?? ''); ?>" disabled>
                                        <option value="">-- Select Barangay --</option>
                                    </select>
                                    <div class="invalid-feedback d-block" style="display: none;"></div>
                                    <small class="hierarchy-indicator">Level 5 of 5 • Required for Philippines</small>
                                </div>
                            </div>

                            <!-- Validation Messages -->
                            <div id="present_address_complete" class="address-validation address-complete-msg" style="display: none;">
                                <i class="fas fa-check-circle"></i> <strong>Address Complete!</strong> Barangay, City/Municipality, Province, Region, Philippines
                            </div>
                            <div id="present_address_incomplete" class="address-validation address-incomplete-msg" style="display: none;">
                                <i class="fas fa-exclamation-triangle"></i> <strong>Incomplete Address:</strong> All 5 levels required for Philippines addresses. Select all dropdowns to continue.
                            </div>
                        </div>

                        <!-- Permanent Address - 6-level cascading selector -->
                        <div class="mb-4">
                            <div class="mb-3 p-3" style="background: rgba(212, 175, 55, 0.1); border-radius: 8px;">
                                <label class="form-label fw-bold">Permanent Address</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="same_address_yes" name="same_as_present" value="yes" <?php echo e(($profile->same_as_present ?? '') == 'yes' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="same_address_yes">
                                        Same as Present Address
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="same_address_no" name="same_as_present" value="no" <?php echo e(($profile->same_as_present ?? '') == 'no' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="same_address_no">
                                        Different Address
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="permanent_address_fields" style="display: <?php echo e(($profile->same_as_present ?? '') == 'no' ? 'block' : 'none'); ?>;">
                            <div class="address-selector-section">
                                <h5><i class="fas fa-map-marker-alt"></i> Permanent Address (Complete Address Required)</h5>
                                <div id="permanent_address_display" class="address-display incomplete">📍 Incomplete address</div>
                                
                                <!-- Address Hierarchy Row 1: Country -->
                                <div class="address-hierarchy-row">
                                    <div class="address-field-group">
                                        <label for="permanent_country" class="form-label">
                                            Country
                                            <span class="required">★</span>
                                        </label>
                                        <select class="form-select is-disabled <?php $__errorArgs = ['permanent_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="permanent_country" name="permanent_country" data-selected="<?php echo e($profile->permanent_country ?? ''); ?>">
                                            <option value="">-- Select Country --</option>
                                        </select>
                                        <div class="invalid-feedback d-block" style="display: none;"></div>
                                        <small class="hierarchy-indicator">Level 1 of 5 • Required for all</small>
                                    </div>
                                </div>

                                <!-- Address Hierarchy Row 2: Region -->
                                <div class="address-hierarchy-row">
                                    <div class="address-field-group">
                                        <label for="permanent_region" class="form-label">
                                            Region
                                            <span class="required">★</span>
                                        </label>
                                        <select class="form-select is-disabled <?php $__errorArgs = ['permanent_region'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="permanent_region" name="permanent_region" data-selected="<?php echo e($profile->permanent_region ?? ''); ?>" disabled>
                                            <option value="">-- Select Region --</option>
                                        </select>
                                        <div class="invalid-feedback d-block" style="display: none;"></div>
                                        <small class="hierarchy-indicator">Level 2 of 5 • Required for Philippines</small>
                                    </div>
                                </div>

                                <!-- Address Hierarchy Row 3: Province -->
                                <div class="address-hierarchy-row">
                                    <div class="address-field-group">
                                        <label for="permanent_province" class="form-label">
                                            Province
                                            <span class="required">★</span>
                                        </label>
                                        <select class="form-select is-disabled <?php $__errorArgs = ['permanent_province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="permanent_province" name="permanent_province" data-selected="<?php echo e($profile->permanent_province ?? ''); ?>" disabled>
                                            <option value="">-- Select Province --</option>
                                        </select>
                                        <div class="invalid-feedback d-block" style="display: none;"></div>
                                        <small class="hierarchy-indicator">Level 3 of 5 • Required for Philippines</small>
                                    </div>
                                </div>

                                <!-- Address Hierarchy Row 4: City/Municipality -->
                                <div class="address-hierarchy-row">
                                    <div class="address-field-group">
                                        <label for="permanent_city" class="form-label">
                                            City/Municipality
                                            <span class="required">★</span>
                                        </label>
                                        <select class="form-select is-disabled <?php $__errorArgs = ['permanent_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="permanent_city" name="permanent_city" data-selected="<?php echo e($profile->permanent_city ?? ''); ?>" disabled>
                                            <option value="">-- Select City/Municipality --</option>
                                        </select>
                                        <div class="invalid-feedback d-block" style="display: none;"></div>
                                        <small class="hierarchy-indicator">Level 4 of 5 • Required for Philippines</small>
                                    </div>
                                </div>

                                <!-- Address Hierarchy Row 5: Barangay -->
                                <div class="address-hierarchy-row">
                                    <div class="address-field-group">
                                        <label for="permanent_barangay" class="form-label">
                                            Barangay
                                            <span class="required">★</span>
                                        </label>
                                        <select class="form-select is-disabled <?php $__errorArgs = ['permanent_barangay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="permanent_barangay" name="permanent_barangay" data-selected="<?php echo e($profile->permanent_barangay ?? ''); ?>" disabled>
                                            <option value="">-- Select Barangay --</option>
                                        </select>
                                        <div class="invalid-feedback d-block" style="display: none;"></div>
                                        <small class="hierarchy-indicator">Level 5 of 5 • Required for Philippines</small>
                                    </div>
                                </div>

                                <!-- Validation Messages -->
                                <div id="permanent_address_complete" class="address-validation address-complete-msg" style="display: none;">
                                    <i class="fas fa-check-circle"></i> <strong>Address Complete!</strong> Barangay, City/Municipality, Province, Region, Philippines
                                </div>
                                <div id="permanent_address_incomplete" class="address-validation address-incomplete-msg" style="display: none;">
                                    <i class="fas fa-exclamation-triangle"></i> <strong>Incomplete Address:</strong> All 5 levels required for Philippines addresses. Select all dropdowns to continue.
                                </div>
                            </div>
                        </div>

                        <!-- Postal Code Fields -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="present_postal_code" class="form-label">Present Postal Code (Optional)</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['present_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="present_postal_code" name="present_postal_code" value="<?php echo e($profile->present_postal_code ?? ''); ?>">
                                <?php $__errorArgs = ['present_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6" id="permanent_postal_code_field" style="display: <?php echo e(($profile->same_as_present ?? '') == 'no' ? 'block' : 'none'); ?>;">
                                <label for="permanent_postal_code" class="form-label">Permanent Postal Code (Optional)</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['permanent_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="permanent_postal_code" name="permanent_postal_code" value="<?php echo e($profile->permanent_postal_code ?? ''); ?>">
                                <?php $__errorArgs = ['permanent_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Occupation (Nature of Work) -->
                        <h5>Occupation (Nature of Work)</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="occupation_type" class="form-label">Type</label>
                                <select class="form-select <?php $__errorArgs = ['occupation_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="occupation_type" name="occupation_type">
                                    <option value="">Select</option>
                                    <option value="Employed" <?php echo e($profile->occupation_type === 'Employed' ? 'selected' : ''); ?>>Employed</option>
                                    <option value="Self-employed" <?php echo e($profile->occupation_type === 'Self-employed' ? 'selected' : ''); ?>>Self-employed</option>
                                    <option value="Unemployed" <?php echo e($profile->occupation_type === 'Unemployed' ? 'selected' : ''); ?>>Unemployed</option>
                                    <option value="Retired" <?php echo e($profile->occupation_type === 'Retired' ? 'selected' : ''); ?>>Retired</option>
                                </select>
                                <?php $__errorArgs = ['occupation_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="employment_type" class="form-label">Employment Type</label>
                                <select class="form-select <?php $__errorArgs = ['employment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="employment_type" name="employment_type">
                                    <option value="">Select</option>
                                    <option value="Public" <?php echo e($profile->employment_type === 'Public' ? 'selected' : ''); ?>>Public (Government Agency)</option>
                                    <option value="Private" <?php echo e($profile->employment_type === 'Private' ? 'selected' : ''); ?>>Private</option>
                                    <option value="NGO" <?php echo e($profile->employment_type === 'NGO' ? 'selected' : ''); ?>>NGO</option>
                                    <option value="Others" <?php echo e($profile->employment_type === 'Others' ? 'selected' : ''); ?>>Others</option>
                                </select>
                                <?php $__errorArgs = ['employment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="job_position" class="form-label">Job Position/Title</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['job_position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="job_position" name="job_position" value="<?php echo e($profile->job_position ?? ''); ?>">
                                <?php $__errorArgs = ['job_position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="company_name" class="form-label">Company/Agency/Business Name</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="company_name" name="company_name" value="<?php echo e($profile->company_name ?? ''); ?>">
                                <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="company_address" class="form-label">Company/Agency/Business Address</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="company_address" name="company_address" value="<?php echo e($profile->company_address ?? ''); ?>">
                                <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Proof of Employment Section -->
                        <div class="mb-4">
                            <div class="card" style="border: 2px dashed #28a745; border-radius: 16px; background: linear-gradient(135deg, rgba(40, 167, 69, 0.05) 0%, rgba(40, 167, 69, 0.02) 100%);">
                                <div class="card-body p-4">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-briefcase" style="font-size: 2.5rem; color: #28a745;"></i>
                                        <h5 class="mt-2 mb-1" style="color: var(--primary-color);">Proof of Employment</h5>
                                        <p class="text-muted small">Upload document to verify your current employment status</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="proof_of_employment" class="form-label" style="font-weight: 600; color: var(--primary-color);">Upload Document</label>
                                        <input type="file" class="form-control <?php $__errorArgs = ['proof_of_employment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="proof_of_employment" name="proof_of_employment" accept="image/*,.pdf" style="padding: 12px; border: 1px solid #28a745;">
                                        <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> Acceptable formats: JPG, PNG, PDF. File size limit: 5MB</small>
                                        <?php $__errorArgs = ['proof_of_employment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    <?php if(!empty($profile->proof_of_employment)): ?>
                                        <div style="border-top: 1px solid rgba(40, 167, 69, 0.3); padding-top: 15px;">
                                            <p class="small text-muted mb-2 text-center">Current Document</p>
                                            <div class="text-center">
                                                <a href="<?php echo e(asset('storage/' . $profile->proof_of_employment)); ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                                    <div style="padding: 12px; border-radius: 8px; background: #f8f9fa; border: 1px solid #dee2e6; text-align: center; transition: all 0.3s ease; display: inline-block;" onmouseover="this.style.background='#e8f5e9'; this.style.borderColor='#28a745';" onmouseout="this.style.background='#f8f9fa'; this.style.borderColor='#dee2e6';">
                                                        <i class="fas fa-file text-success" style="font-size: 1.5rem;"></i>
                                                        <p class="small mb-0" style="color: var(--primary-color); font-weight: 500; margin-top: 5px;">View Document</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete this proof of employment document?')) { document.getElementById('delete-proof-form').submit(); }">
                                                    <i class="fas fa-trash"></i> Delete Document
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2" style="margin-top: 2rem;">
                            <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, var(--primary-color) 0%, #2d5016 100%); border: none; padding: 10px 30px; font-weight: 600; box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <a href="<?php echo e(route('alumni.dashboard')); ?>" class="btn btn-secondary" style="padding: 10px 30px; font-weight: 600;">Cancel</a>
                        </div>
                    </form>

                    <form id="delete-proof-form" action="<?php echo e(route('alumni.deleteProofOfEmployment')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteProofModal" tabindex="-1" aria-labelledby="deleteProofModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProofModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete your proof of employment document? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" id="confirm-delete-proof">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/cascading-address-selector.js')); ?>"></script>
<script>
    // Handle "Same as present address" toggle
    document.addEventListener('DOMContentLoaded', () => {
        const sameYes = document.getElementById('same_address_yes');
        const sameNo = document.getElementById('same_address_no');
        const permanentFields = document.getElementById('permanent_address_fields');
        const permanentPostalField = document.getElementById('permanent_postal_code_field');

        const togglePermanentFields = () => {
            if (!permanentFields) return;
            
            const isSame = sameYes && sameYes.checked;
            permanentFields.style.display = isSame ? 'none' : 'block';
            if (permanentPostalField) {
                permanentPostalField.style.display = isSame ? 'none' : 'block';
            }
            
            // Disable/enable all form controls in permanent address section
            permanentFields.querySelectorAll('select, input').forEach(el => {
                el.disabled = isSame;
                if (isSame) {
                    el.classList.add('is-disabled');
                    el.classList.remove('is-ready', 'is-error', 'is-loading');
                }
            });
        };

        if (sameYes && sameNo) {
            sameYes.addEventListener('change', togglePermanentFields);
            sameNo.addEventListener('change', togglePermanentFields);
            // Initialize on page load
            setTimeout(togglePermanentFields, 100);
        }
    });

    document.getElementById('confirm-delete-proof')?.addEventListener('click', function () {
        document.getElementById('delete-proof-form').submit();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.alumni', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\alumni system\resources\views/alumni/profile.blade.php ENDPATH**/ ?>