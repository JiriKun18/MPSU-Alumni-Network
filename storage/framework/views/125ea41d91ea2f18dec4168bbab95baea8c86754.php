

<?php $__env->startSection('title', 'Alumni Dashboard - MPSU Alumni Network'); ?>

<?php $__env->startSection('content'); ?>
<?php if(!$user->is_verified): ?>
<div class="container mt-4">
    <div class="alert alert-warning" role="alert">
        <strong>Verification pending:</strong> Please upload your alumni verification documents in your profile. Limited access will apply until admin approval.
    </div>
</div>
<?php endif; ?>

<!-- Welcome Hero Section -->
<section style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); padding: 3rem 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <?php
                    $displayFullName = implode(' ', array_filter([
                        $profile->family_name ?? '',
                        $profile->given_name ?? '',
                        $profile->middle_initial ?? '',
                        $profile->suffix ?? '',
                    ]));
                ?>
                <h1 style="font-size: 2.5rem; font-weight: 900; margin-bottom: 1rem;">Welcome Back, <?php echo e($displayFullName ?: Auth::user()->name); ?>! 👋</h1>
                <p style="font-size: 1.2rem; opacity: 0.95; margin-bottom: 2rem;">Stay connected, grow your network, and give back to your alma mater. Explore opportunities and engage with the MPSU community.</p>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="<?php echo e(route('alumni.profile.edit')); ?>" style="background: var(--accent-gold); color: var(--primary-color); padding: 0.85rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 1rem; transition: all 0.3s ease; display: inline-block;">
                        <i class="fas fa-user-edit"></i> Update Your Profile
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <?php if(Auth::user()->alumniProfile && Auth::user()->alumniProfile->profile_picture): ?>
                    <img src="<?php echo e(asset('storage/' . Auth::user()->alumniProfile->profile_picture)); ?>" 
                         alt="<?php echo e(Auth::user()->name); ?>" 
                         style="width: 180px; height: 180px; border-radius: 50%; border: 5px solid var(--accent-gold); object-fit: cover; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/logo_mpsu.png')); ?>" 
                         alt="<?php echo e(Auth::user()->name); ?>" 
                         style="width: 180px; height: 180px; border-radius: 50%; border: 5px solid var(--accent-gold); object-fit: cover; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Quick Access Shortcuts -->
<section style="background: white; padding: 3rem 0;">
    <div class="container">
        <h2 style="font-size: 2rem; font-weight: 900; color: var(--primary-color); margin-bottom: 2rem; text-align: center;">Quick Access</h2>
        <div class="row g-4">
            <div class="col-md-4 col-sm-6">
                <a href="<?php echo e(route('alumni.alumni-dir')); ?>" style="text-decoration: none;">
                    <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                        <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1rem;">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.5rem;">Alumni Directory</h5>
                        <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Find and connect with classmates</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="<?php echo e(route('events.index')); ?>" style="text-decoration: none;">
                    <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                        <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1rem;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.5rem;">Events & Reunions</h5>
                        <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Join upcoming alumni events</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="<?php echo e(route('jobs.index')); ?>" style="text-decoration: none;">
                    <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                        <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1rem;">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.5rem;">Jobs & Internships</h5>
                        <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Explore career opportunities</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="<?php echo e(route('surveys.index')); ?>" style="text-decoration: none;">
                    <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                        <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1rem;">
                            <i class="fas fa-poll"></i>
                        </div>
                        <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.5rem;">Surveys</h5>
                        <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Share your feedback</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="<?php echo e(route('news.index')); ?>" style="text-decoration: none;">
                    <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                        <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1rem;">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.5rem;">Announcements</h5>
                        <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Stay updated with news</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="<?php echo e(route('alumni.profile')); ?>" style="text-decoration: none;">
                    <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid transparent;">
                        <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1rem;">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.5rem;">My Profile</h5>
                        <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Manage your information</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events and Latest News -->
<section style="background: white; padding: 3rem 0;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h3 style="font-size: 2rem; font-weight: 900; color: var(--primary-color); margin: 0;">
                        <i class="fas fa-calendar-alt"></i> Upcoming Events
                    </h3>
                    <a href="<?php echo e(route('events.index')); ?>" style="color: var(--accent-gold); font-weight: 600; text-decoration: none;">View All Events →</a>
                </div>

                <?php
                    $upcomingEvents = \App\Models\Event::where('event_date', '>=', now())
                        ->orderBy('event_date', 'asc')
                        ->take(10)
                        ->get();
                ?>

                <?php if($upcomingEvents->count() > 0): ?>
                <div class="row g-4" style="max-height: 520px; overflow-y: auto; padding-right: 8px;">
                    <?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12">
                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column; border-top: 4px solid var(--accent-gold);">
                            <?php if($event->image): ?>
                                <img src="<?php echo e(asset('storage/' . $event->image)); ?>" alt="<?php echo e($event->title); ?>" style="width: 100%; height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-calendar-alt fa-3x" style="color: rgba(255,255,255,0.3);"></i>
                                </div>
                            <?php endif; ?>
                            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                                <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <?php echo e(\Carbon\Carbon::parse($event->event_date)->format('M d, Y')); ?>

                                </small>
                                <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.75rem; margin-top: 0.5rem;"><?php echo e($event->title); ?></h5>
                                <?php if($event->venue): ?>
                                <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 0.75rem;">
                                    <i class="fas fa-map-marker-alt"></i> <?php echo e($event->venue); ?>

                                </div>
                                <?php endif; ?>
                                <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1rem; flex: 1;">
                                    <?php echo e(\Illuminate\Support\Str::limit(strip_tags($event->description), 100)); ?>

                                </p>
                                <a href="<?php echo e(route('events.show', $event->id)); ?>" style="display: inline-block; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; align-self: flex-start;">Read More</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div style="text-align: center; padding: 3rem; background: #f8fafc; border-radius: 12px;">
                    <i class="fas fa-calendar-times fa-3x mb-3" style="color: #cbd5e1;"></i>
                    <h5 style="color: #64748b;">No upcoming events</h5>
                    <p style="color: #94a3b8;">Check back soon for new events</p>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h3 style="font-size: 2rem; font-weight: 900; color: var(--primary-color); margin: 0;">
                        <i class="fas fa-newspaper"></i> Latest News
                    </h3>
                    <a href="<?php echo e(route('news.index')); ?>" style="color: var(--accent-gold); font-weight: 600; text-decoration: none;">View All News →</a>
                </div>

                <?php
                    $latestNews = \App\Models\News::where('is_published', true)
                        ->orderBy('published_at', 'desc')
                        ->take(10)
                        ->get();
                ?>

                <?php if($latestNews->count() > 0): ?>
                <div class="row g-4" style="max-height: 520px; overflow-y: auto; padding-right: 8px;">
                    <?php $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12">
                        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column;">
                            <?php if($news->featured_image): ?>
                                <img src="<?php echo e(asset('storage/' . $news->featured_image)); ?>" alt="<?php echo e($news->title); ?>" style="width: 100%; height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-newspaper fa-3x" style="color: rgba(255,255,255,0.3);"></i>
                                </div>
                            <?php endif; ?>
                            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                                <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <?php echo e($news->published_at->format('M d, Y')); ?>

                                </small>
                                <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.75rem; margin-top: 0.5rem;"><?php echo e($news->title); ?></h5>
                                <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1rem; flex: 1;">
                                    <?php echo e(\Illuminate\Support\Str::limit(strip_tags($news->content), 100)); ?>

                                </p>
                                <a href="<?php echo e(route('news.show', $news->id)); ?>" style="display: inline-block; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; align-self: flex-start;">Read More</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div style="text-align: center; padding: 3rem; background: #f8fafc; border-radius: 12px;">
                    <i class="fas fa-newspaper fa-3x mb-3" style="color: #cbd5e1;"></i>
                    <h5 style="color: #64748b;">No news available at the moment</h5>
                    <p style="color: #94a3b8;">Check back later for updates</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Job Opportunities -->
<section style="background: white; padding: 3rem 0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 style="font-size: 2rem; font-weight: 900; color: var(--primary-color); margin: 0;">
                <i class="fas fa-briefcase"></i> Latest Job Opportunities
            </h3>
            <a href="<?php echo e(route('jobs.index')); ?>" style="color: var(--accent-gold); font-weight: 600; text-decoration: none;">View All Jobs →</a>
        </div>
        
        <?php
            $latestJobs = \App\Models\JobPosting::where('is_active', true)
                ->where('approval_status', 'approved')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        ?>
        
        <?php if(!auth()->user()->is_verified): ?>
        <div style="text-align: center; padding: 3rem; background: #fff3cd; border-radius: 12px; border: 2px solid #ffc107;">
            <i class="fas fa-clock fa-3x mb-3" style="color: #ffc107;"></i>
            <h5 style="color: #856404;">Account Pending Approval</h5>
            <p style="color: #856404;">Your account is pending admin approval. Job listings will be available once your account is verified.</p>
        </div>
        <?php elseif($latestJobs->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $latestJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-top: 4px solid var(--accent-gold); height: 100%;">
                    <div class="row g-3 align-items-stretch">
                        <div class="col-12 col-md-7">
                            <h5 style="font-weight: 700; color: var(--primary-color); margin-bottom: 0.75rem;"><?php echo e($job->title); ?></h5>
                            <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 0.5rem;">
                                <i class="fas fa-building"></i> <?php echo e($job->company_name); ?>

                            </div>
                            <?php if($job->location): ?>
                            <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 0.5rem;">
                                <i class="fas fa-map-marker-alt"></i> <?php echo e($job->location); ?>

                            </div>
                            <?php endif; ?>
                            <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">
                                <i class="fas fa-clock"></i> Posted <?php echo e($job->created_at->diffForHumans()); ?>

                            </div>
                            <a href="<?php echo e(route('jobs.show', $job->id)); ?>" style="display: inline-block; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">View Details</a>
                        </div>
                        <div class="col-12 col-md-5">
                            <?php
                                $mapQuery = trim($job->contact_address ?: ($job->location ?: $job->company_name));
                            ?>
                            <div class="job-map-canvas" data-lat="<?php echo e($job->latitude); ?>" data-lng="<?php echo e($job->longitude); ?>" data-map="<?php echo e($mapQuery); ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div style="text-align: center; padding: 3rem; background: #f8fafc; border-radius: 12px;">
            <i class="fas fa-briefcase fa-3x mb-3" style="color: #cbd5e1;"></i>
            <h5 style="color: #64748b;">No job postings available at the moment</h5>
            <p style="color: #94a3b8;">Check back later for new opportunities</p>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<style>
    .job-map-canvas {
        height: 150px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        overflow: hidden;
    }
    .job-map-empty {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 0.85rem;
        text-align: center;
        padding: 0.75rem;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var mapElements = document.querySelectorAll('.job-map-canvas');
        if (!mapElements.length) {
            return;
        }

        mapElements.forEach(function (el) {
            var lat = parseFloat(el.dataset.lat);
            var lng = parseFloat(el.dataset.lng);
            if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
                var mapQuery = (el.dataset.map || '').trim();
                if (mapQuery) {
                    var mapUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(mapQuery) + '&output=embed';
                    el.innerHTML = '<iframe title="Job location map" src="' + mapUrl + '" width="100%" height="150" style="border:0; display:block;" loading="lazy"></iframe>';
                } else {
                    el.innerHTML = '<div class="job-map-empty">Map not set</div>';
                }
                return;
            }

            var map = L.map(el, {
                zoomControl: false,
                attributionControl: false
            }).setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            L.marker([lat, lng]).addTo(map);
        });
    });
</script>
<?php $__env->stopPush(); ?>

<!-- Your Dashboard Stats -->
<section style="background: #f8fafc; padding: 3rem 0;">
    <div class="container">
        <h3 style="font-size: 2rem; font-weight: 900; color: var(--primary-color); margin-bottom: 2rem; text-align: center;">Your Activity</h3>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-top: 4px solid var(--primary-color);">
                    <i class="fas fa-user-check" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 2rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;"><?php echo e($profile ? '✓' : '✗'); ?></h3>
                    <p style="color: #64748b; font-weight: 600; margin: 0;">Profile Status</p>
                    <small style="color: #94a3b8;"><?php echo e($profile ? 'Complete' : 'Incomplete'); ?></small>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-top: 4px solid var(--secondary-color);">
                    <i class="fas fa-briefcase" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 2rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;"><?php echo e(Auth::user()->jobApplications()->count()); ?></h3>
                    <p style="color: #64748b; font-weight: 600; margin: 0;">Job Applications</p>
                    <small style="color: #94a3b8;">Total submitted</small>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-top: 4px solid var(--accent-gold);">
                    <i class="fas fa-calendar-check" style="font-size: 2.5rem; color: var(--accent-gold); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 2rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;"><?php echo e(Auth::user()->eventRegistrations()->count()); ?></h3>
                    <p style="color: #64748b; font-weight: 600; margin: 0;">Event Registrations</p>
                    <small style="color: #94a3b8;">Upcoming & past</small>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-top: 4px solid #059669;">
                    <i class="fas fa-poll" style="font-size: 2.5rem; color: #059669; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 2rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;">
                        <?php echo e(\App\Models\Survey::count()); ?>

                    </h3>
                    <p style="color: #64748b; font-weight: 600; margin: 0;">Available Surveys</p>
                    <small style="color: #94a3b8;">Total surveys</small>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.alumni', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\alumni system\resources\views/alumni/dashboard.blade.php ENDPATH**/ ?>