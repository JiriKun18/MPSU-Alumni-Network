
<?php $__env->startSection('title', $news->title); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="mb-4">
        <button type="button" class="btn btn-secondary btn-sm mb-2" onclick="window.history.back()">
          <i class="fa-solid fa-arrow-left-long"></i> Back
        </button>
        <h1 class="fw-bold" style="color: var(--primary-color);"><?php echo e($news->title); ?></h1>
        <div class="text-muted mb-2">
          <i class="fas fa-calendar-alt"></i> <?php echo e($news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('F d, Y') : 'Unpublished'); ?>

          <?php if($news->author): ?>
            &nbsp;|&nbsp; <i class="fas fa-user"></i> <?php echo e($news->author->name); ?>

          <?php endif; ?>
        </div>
        <?php if($news->featured_image): ?>
          <img src="<?php echo e(asset('storage/' . $news->featured_image)); ?>" alt="<?php echo e($news->title); ?>" class="img-fluid rounded mb-3" style="max-height: 420px; width: 100%; object-fit: cover;">
        <?php endif; ?>
        <div class="mb-4" style="font-size: 1.15rem; line-height: 1.7; text-align: justify;">
          <?php echo nl2br(e($news->content)); ?>

        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card" style="border-radius: 12px; border: 1px solid rgba(13, 77, 45, 0.2);">
        <div class="card-body">
          <h5 class="fw-bold mb-3" style="color: var(--primary-color);">More Photos</h5>
          <?php if($news->images && $news->images->count()): ?>
            <div class="row g-2">
              <?php $__currentLoopData = $news->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6">
                  <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="News image" style="width: 100%; height: 110px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(13, 77, 45, 0.15);">
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php else: ?>
            <p class="text-muted mb-0">No additional photos.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php if($relatedNews && $relatedNews->count()): ?>
    <div class="mt-5">
      <h4 class="fw-bold mb-3">Related News</h4>
      <div class="row justify-content-center">
        <?php $__currentLoopData = $relatedNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <?php if($item->featured_image): ?>
                <img src="<?php echo e(asset('storage/' . $item->featured_image)); ?>" class="card-img-top" alt="<?php echo e($item->title); ?>" style="height: 160px; object-fit: cover;">
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo e($item->title); ?></h5>
                <p class="card-text"><?php echo e($item->getExcerpt(80)); ?></p>
                <a href="<?php echo e(route('news.show', $item->id)); ?>" class="btn btn-sm btn-primary">Read More</a>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  <?php endif; ?>
  <?php
    $prevNews = \App\Models\News::where('is_published', 1)
        ->where('id', '<', $news->id)
        ->orderByDesc('id')
        ->first();
    $nextNews = \App\Models\News::where('is_published', 1)
        ->where('id', '>', $news->id)
        ->orderBy('id')
        ->first();
  ?>
  <div class="mt-5 d-flex justify-content-between align-items-center" style="max-width: 700px; margin-left: auto; margin-right: auto;">
    <?php if($prevNews): ?>
      <a href="<?php echo e(route('news.show', $prevNews->id)); ?>" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Previous
      </a>
    <?php else: ?>
      <span class="text-muted">
        <i class="fas fa-arrow-left"></i> Previous
      </span>
    <?php endif; ?>

    <?php if($nextNews): ?>
      <a href="<?php echo e(route('news.show', $nextNews->id)); ?>" class="btn btn-outline-secondary">
        Next <i class="fas fa-arrow-right"></i>
      </a>
    <?php else: ?>
      <span class="text-muted">
        Next <i class="fas fa-arrow-right"></i>
      </span>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.alumni', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\alumni system\resources\views/news/show.blade.php ENDPATH**/ ?>