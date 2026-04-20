
<?php $__env->startSection('title','News'); ?>
<?php $__env->startSection('content'); ?>

<!-- HEADER SECTION -->
<div style="background-color: transparent; padding: 3rem 0; margin-bottom: 2rem;">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3">
            <div>
                <h1 style="font-size: 2.5rem; font-weight: 900; color: var(--primary-color); margin: 0;">
                    <i class="fas fa-newspaper"></i> News & Updates
                </h1>
                <p style="color: var(--text-secondary); font-size: 1.1rem; margin: 0.5rem 0 0 0;">Latest news from MPSU Alumni Network</p>
            </div>
            <div style="width: 100%; max-width: 520px;">
                <form method="GET" action="<?php echo e(route('news.index')); ?>" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Search news..." value="<?php echo e($search); ?>" style="border-radius: 8px;">
                    <button type="submit" class="btn" style="background: var(--primary-color); color: white; border-radius: 8px; padding: 0.5rem 1rem; font-weight: 600; white-space: nowrap; width: auto; flex: 0 0 auto;">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CONTENT SECTION -->
<div class="container-fluid" style="padding-bottom: 4rem;">
    <!-- News Grid -->
    <?php if($news->count() > 0): ?>
    <div class="row">
        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card h-100" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 2px solid var(--primary-color); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;">
                <!-- Featured Image -->
                <?php if($article->featured_image): ?>
                    <img src="<?php echo e(asset('storage/' . $article->featured_image)); ?>" alt="<?php echo e($article->title); ?>" class="card-img-top" style="height: 280px; width: 100%; object-fit: cover; display: block;">
                    <hr style="margin: 0; border-top: 1px solid rgba(13, 77, 45, 0.25);">
                <?php else: ?>
                    <div style="height: 280px; background: linear-gradient(135deg, var(--primary-color) 0%, #1a6b3d 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-newspaper fa-4x" style="color: rgba(255,255,255,0.3);"></i>
                    </div>
                    <hr style="margin: 0; border-top: 1px solid rgba(13, 77, 45, 0.25);">
                <?php endif; ?>

                <div class="card-body d-flex flex-column">
                    <!-- Title -->
                    <h5 class="card-title mb-2" style="color: var(--primary-color); font-weight: 700; line-height: 1.4;">
                        <?php echo e(Str::limit($article->title, 60)); ?>

                    </h5>

                    <!-- Content Preview -->
                    <p class="card-text text-muted mb-3" style="flex-grow: 1; font-size: 0.9rem;">
                        <?php echo e(Str::limit(strip_tags($article->content), 100)); ?>

                    </p>

                    <!-- Meta Info -->
                    <div style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 1rem;">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo e($article->published_at?->format('M d, Y') ?? $article->created_at->format('M d, Y')); ?>

                    </div>

                    <!-- Read More Link -->
                    <a href="<?php echo e(route('news.show', $article->id)); ?>" class="btn btn-sm" style="background: var(--primary-color); color: white; border: none; border-radius: 6px; padding: 0.5rem 1rem; font-weight: 600; align-self: flex-start;">
                        <i class="fas fa-arrow-right"></i> Read More
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <?php echo e($news->links('pagination::bootstrap-4')); ?>

    </div>

    <?php else: ?>
    <div class="card text-center py-5" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
        <i class="fas fa-newspaper fa-3x mb-3" style="color: #cbd5e1;"></i>
        <h5 class="text-muted mb-2">No News Available</h5>
        <p class="text-muted mb-0">Check back soon for the latest updates from MPSU Alumni Network.</p>
    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.alumni', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\alumni system\resources\views/news/index.blade.php ENDPATH**/ ?>