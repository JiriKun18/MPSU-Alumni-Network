

<?php $__env->startSection('title', 'Jobs - MPSU Alumni Network'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2><i class="fas fa-briefcase"></i> Job Opportunities</h2>
            <p class="text-muted">Explore career opportunities posted for our alumni</p>
        </div>
    </div>

    <?php if(!empty($verificationRequired) && $verificationRequired): ?>
        <div class="alert alert-warning" role="alert">
            <strong>Verification required:</strong> Your account is pending approval. Please wait for admin verification before accessing job postings.
        </div>
    <?php else: ?>

    <div class="row mb-4">
        <div class="col-md-8">
            <form class="row g-3" method="GET" action="<?php echo e(route('jobs.index')); ?>">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="search" placeholder="Search jobs..." value="<?php echo e($search); ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="company" placeholder="Company..." value="<?php echo e($company); ?>">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="position_type">
                        <option value="">All Types</option>
                        <option value="Full-time" <?php echo e($position === 'Full-time' ? 'selected' : ''); ?>>Full-time</option>
                        <option value="Part-time" <?php echo e($position === 'Part-time' ? 'selected' : ''); ?>>Part-time</option>
                        <option value="Contract" <?php echo e($position === 'Contract' ? 'selected' : ''); ?>>Contract</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-end d-flex align-items-start justify-content-end">
            <a href="<?php echo e(route('jobs.create')); ?>" class="btn btn-warning" style="font-weight:700; border-radius:8px; min-width:140px;"> <i class="fas fa-plus"></i> Post a Job</a>
        </div>
    </div>

    <?php if($jobs->count() > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="card-title"><?php echo e($job->title); ?></h5>
                                    <p class="text-muted mb-2"><?php echo e($job->company_name); ?></p>
                                    <p class="card-text small"><?php echo e(Str::limit($job->description, 150)); ?></p>
                                    <div class="mt-2">
                                        <span class="badge bg-primary"><?php echo e($job->position_type); ?></span>
                                        <span class="badge bg-secondary"><?php echo e($job->location); ?></span>
                                        <?php if($job->salary_min && $job->salary_max): ?>
                                            <span class="badge bg-success"><?php echo e(number_format($job->salary_min)); ?> - <?php echo e(number_format($job->salary_max)); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-2">
                                        <small><strong>Contact:</strong> <?php echo e($job->contact_email); ?>

                                            <?php if($job->contact_phone): ?> | <?php echo e($job->contact_phone); ?> <?php endif; ?>
                                        </small>
                                    </div>
                                    <div class="mt-2">
                                        <small>
                                            <strong>Status:</strong>
                                            <?php if($job->approval_status === 'approved'): ?>
                                                <span class="badge bg-success">Approved</span>
                                            <?php elseif($job->approval_status === 'pending'): ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Rejected</span>
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <p class="mb-2">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i>
                                            Deadline: <?php echo e($job->deadline->format('M d, Y')); ?>

                                        </small>
                                    </p>
                                    <?php if($job->isExpired()): ?>
                                        <span class="badge bg-danger">Expired</span>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('jobs.show', $job->id)); ?>" class="btn btn-primary btn-sm">View Details</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php echo e($jobs->links()); ?>

    <?php else: ?>
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-inbox fa-3x mb-3"></i>
            <p>No job postings found. Check back later!</p>
        </div>
    <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.alumni', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\alumni system\resources\views/jobs/index.blade.php ENDPATH**/ ?>