

<?php $__env->startSection('title', 'My Profile - MPSU Alumni Network'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <?php if(!$profile): ?>
                <div class="alert alert-warning" role="alert">
                    <strong>No profile details found.</strong> Click Edit Profile to complete your information.
                </div>
            <?php else: ?>
                <!-- Single Card - Facebook Style -->
                <div class="card-premium" style="overflow: visible;">
                    <!-- Cover/Header Section with MPSU Logo Background -->
                    <div style="background: white url('<?php echo e(asset('images/logo_mpsu.png')); ?>') center/300px no-repeat; height: 320px; position: relative; border-radius: 16px 16px 0 0; border-bottom: 3px solid var(--border-color);"></div>
                    
                    <!-- Profile Picture & Name Section -->
                    <div style="padding: 0 2rem; margin-top: -80px; position: relative;">
                        <div style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border-color);">
                            <div>
                                <?php if($profile->profile_picture): ?>
                                    <img src="<?php echo e(asset('storage/' . $profile->profile_picture)); ?>" alt="<?php echo e($user->name); ?>" style="width: 160px; height: 160px; border-radius: 50%; object-fit: cover; border: 5px solid white; box-shadow: 0 8px 24px rgba(0,0,0,0.2);">
                                <?php else: ?>
                                    <div style="width: 160px; height: 160px; border-radius: 50%; background: var(--accent-gold); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-size: 3.5rem; font-weight: 800; border: 5px solid white; box-shadow: 0 8px 24px rgba(0,0,0,0.2);">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            <div style="flex: 1; min-width: 200px;">
                                <h2 style="font-weight: 900; color: var(--primary-color); margin-bottom: 0.25rem;">
                                    <?php
                                        $displayFullName = implode(' ', array_filter([
                                            $profile->family_name ?? '',
                                            $profile->given_name ?? '',
                                            $profile->middle_initial ?? '',
                                            $profile->suffix ?? '',
                                        ]));
                                    ?>
                                    <?php echo e($displayFullName ?: $user->name); ?>

                                </h2>
                                <?php if($profile->current_position || $profile->current_company): ?>
                                    <p style="font-size: 1.05rem; color: var(--text-secondary); margin-bottom: 0.5rem;">
                                        <?php if($profile->current_position): ?><?php echo e($profile->current_position); ?><?php endif; ?>
                                        <?php if($profile->current_position && $profile->current_company): ?> at <?php endif; ?>
                                        <?php if($profile->current_company): ?><?php echo e($profile->current_company); ?><?php endif; ?>
                                    </p>
                                <?php endif; ?>
                                <p style="color: #64748b; margin-bottom: 0;">
                                    <?php
                                        $headerAddress = implode(', ', array_filter([
                                            $profile->present_address,
                                            $profile->present_barangay,
                                            $profile->present_city,
                                            $profile->present_province,
                                            $profile->present_region,
                                            $profile->present_country,
                                        ]));
                                    ?>
                                    <?php if($headerAddress): ?>
                                        <i class="fas fa-map-marker-alt"></i> <?php echo e($headerAddress); ?>

                                    <?php endif; ?>
                                </p>
                            </div>
                            <div style="margin-left: auto;">
                                <a href="<?php echo e(route('alumni.profile.edit')); ?>" class="btn btn-premium" style="white-space: nowrap;">
                                    <i class="fas fa-pen"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Bio Section -->
                    <?php if($profile->bio): ?>
                    <div style="padding: 1.5rem 2rem; border-bottom: 1px solid var(--border-color);">
                        <p style="margin: 0; color: var(--text-secondary); font-size: 1rem; line-height: 1.6;"><?php echo e($profile->bio); ?></p>
                    </div>
                    <?php endif; ?>

                    <!-- Personal Information Section -->
                    <div style="padding: 2rem;">
                        <h5 style="font-weight: 800; color: var(--primary-color); margin-bottom: 1.5rem; font-size: 1.25rem;">
                            <i class="fas fa-user"></i> Personal Information
                        </h5>
                        <div class="row g-3">
                            <?php if($profile->family_name): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-user-tag" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Family Name</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->family_name); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profile->given_name): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-user-tag" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Given Name</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->given_name); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profile->middle_initial): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-user-tag" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Middle Initial</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->middle_initial); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profile->suffix): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-user-tag" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Suffix</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->suffix); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profile->sex): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-venus-mars" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Gender</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->sex); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profile->date_of_birth): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-birthday-cake" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Date of Birth</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e(\Carbon\Carbon::parse($profile->date_of_birth)->format('F j, Y')); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div style="padding: 2rem; border-top: 1px solid var(--border-color);">
                        <h5 style="font-weight: 800; color: var(--primary-color); margin-bottom: 1.5rem; font-size: 1.25rem;">
                            <i class="fas fa-address-book"></i> Contact Information
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-envelope" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Email</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($user->email); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if($profile->phone): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-phone" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Phone</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->phone); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profile->linkedin_url): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fab fa-linkedin" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">LinkedIn</small>
                                        <p style="margin: 0;"><a href="<?php echo e($profile->linkedin_url); ?>" target="_blank" style="color: #0077b5; text-decoration: none; font-weight: 600;">View Profile</a></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profile->facebook_url): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fab fa-facebook" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Facebook</small>
                                        <p style="margin: 0;"><a href="<?php echo e($profile->facebook_url); ?>" target="_blank" style="color: #1877f2; text-decoration: none; font-weight: 600;">View Profile</a></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Present Address Section -->
                    <?php
                        $presentLine1 = implode(', ', array_filter([
                            $profile->present_address,
                            $profile->present_barangay,
                            $profile->present_city,
                            $profile->present_province,
                            $profile->present_region,
                        ]));
                        $presentLine2 = $profile->present_postal_code;
                        $presentLine3 = $profile->present_country;
                        $presentFullAddress = implode(', ', array_filter([$presentLine1, $presentLine2, $presentLine3]));
                    ?>
                    <?php if($presentFullAddress): ?>
                    <div style="padding: 2rem; border-top: 1px solid var(--border-color);">
                        <h5 style="font-weight: 800; color: var(--primary-color); margin-bottom: 1.5rem; font-size: 1.25rem;">
                            <i class="fas fa-home"></i> Present Address
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Complete Address</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;">
                                            <?php if($presentLine1): ?>
                                                <?php echo e($presentLine1); ?><br>
                                            <?php endif; ?>
                                            <?php if($presentLine2): ?>
                                                <?php echo e($presentLine2); ?><br>
                                            <?php endif; ?>
                                            <?php if($presentLine3): ?>
                                                <?php echo e($presentLine3); ?>

                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Permanent Address Section -->
                    <?php
                        $permanentLine1 = implode(', ', array_filter([
                            $profile->permanent_address,
                            $profile->permanent_barangay,
                            $profile->permanent_city,
                            $profile->permanent_province,
                        ]));
                        $permanentLine2 = $profile->permanent_postal_code;
                        $permanentLine3 = $profile->permanent_country;
                        $permanentFullAddress = implode(', ', array_filter([$permanentLine1, $permanentLine2, $permanentLine3]));
                    ?>
                    <?php if($permanentFullAddress): ?>
                    <div style="padding: 2rem; border-top: 1px solid var(--border-color);">
                        <h5 style="font-weight: 800; color: var(--primary-color); margin-bottom: 1.5rem; font-size: 1.25rem;">
                            <i class="fas fa-home"></i> Permanent Address
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Complete Address</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;">
                                            <?php if($permanentLine1): ?>
                                                <?php echo e($permanentLine1); ?><br>
                                            <?php endif; ?>
                                            <?php if($permanentLine2): ?>
                                                <?php echo e($permanentLine2); ?><br>
                                            <?php endif; ?>
                                            <?php if($permanentLine3): ?>
                                                <?php echo e($permanentLine3); ?>

                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Education Section -->
                    <div style="padding: 2rem; border-top: 1px solid var(--border-color);">
                        <h5 style="font-weight: 800; color: var(--primary-color); margin-bottom: 1.5rem; font-size: 1.25rem;">
                            <i class="fas fa-graduation-cap"></i> Education
                        </h5>
                        <div class="row g-3">
                            <?php if($profile->course): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-book" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Course</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->course); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($profile->batch): ?>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-calendar-alt" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Batch Year</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->batch->year); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Work & Career Section -->
                    <div style="padding: 2rem; border-top: 1px solid var(--border-color);">
                        <h5 style="font-weight: 800; color: var(--primary-color); margin-bottom: 1.5rem; font-size: 1.25rem;">
                            <i class="fas fa-briefcase"></i> Work & Career
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-chart-line" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Employment Status</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600; text-transform: capitalize;"><?php echo e($profile->employment_status ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-user-tie" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Occupation Type</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->occupation_type ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-building" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Employment Type</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->employment_type ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-id-badge" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Current Position</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->current_position ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-id-badge" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Job Position/Title</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->job_position ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-briefcase" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Current Company</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->current_company ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-briefcase" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Company/Agency/Business Name</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->company_name ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-globe" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Company Country</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->company_country ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div style="display: flex; align-items: start; gap: 12px; padding: 0.75rem 0;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--accent-gold); width: 20px; margin-top: 2px;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">Company Address</small>
                                        <p style="margin: 0; color: var(--primary-color); font-weight: 600;"><?php echo e($profile->company_address ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.alumni', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\alumni system\resources\views/alumni/profile-show.blade.php ENDPATH**/ ?>