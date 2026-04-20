
<?php $__env->startSection('title','Event Details'); ?>
<?php $__env->startSection('content'); ?>
<style>
.event-main-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    color: #093b1a;
    line-height: 1.1;
}
.event-meta-info {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 1.5rem;
}
.event-meta-info i {
    color: #d4af37;
    margin-right: 0.5rem;
}
.event-content {
    font-size: 1.15rem;
    color: #222;
    margin-bottom: 2rem;
}
.event-back-link {
    background: #14532d;
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 4px;
    padding: 0.5rem 1.5rem;
    font-size: 1rem;
    transition: background 0.2s;
    text-decoration: none;
}
.event-back-link:hover {
    background: #166534;
    color: #ffd700;
}
.event-sidebar {
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    padding: 1.5rem 1rem;
    margin-top: 2rem;
}
.event-sidebar-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #222;
  margin-bottom: 1rem;
  border-bottom: 2px solid #facc15;
  padding-bottom: 0.5rem;
}
.event-sidebar-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.event-sidebar-list li {
    margin-bottom: 0.75rem;
}
.event-sidebar-list a {
  color: #222;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.2s;
}
.event-sidebar-list a:hover {
  color: #facc15;
}
</style>
<div class="container" style="max-width: 1200px;">
  <div class="mb-3">
    <button type="button" class="btn btn-secondary btn-sm event-back-link" onclick="window.history.back()">
      <i class="fa-solid fa-arrow-left-long"></i> Back
    </button>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <div class="card h-100" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none; overflow: hidden; margin-bottom:2rem;">
        <?php
          $carouselImages = [];
          if ($event->image) {
              $carouselImages[] = $event->image;
          }
          if ($event->images && $event->images->count()) {
              foreach ($event->images as $img) {
                  $carouselImages[] = $img->image_path;
              }
          }
        ?>
        <?php if(count($carouselImages) > 0): ?>
          <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php $__currentLoopData = $carouselImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $imgPath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                  <img src="<?php echo e(asset('storage/' . $imgPath)); ?>" class="d-block w-100" alt="<?php echo e($event->title); ?>" style="height: 260px; object-fit: cover;">
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if(count($carouselImages) > 1): ?>
              <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            <?php endif; ?>
          </div>
        <?php else: ?>
          <div style="height: 260px; background: linear-gradient(135deg, var(--primary-color) 0%, #1a6b3d 100%); display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-calendar-alt fa-4x" style="color: rgba(255,255,255,0.3);"></i>
          </div>
        <?php endif; ?>
        <div class="card-body d-flex flex-column">
          <h2 class="event-main-title mb-2" style="color: var(--primary-color); font-weight: 800; line-height: 1.2;"><?php echo e($event->title); ?></h2>
          <div class="event-meta-info mb-3" style="font-size: 1.1rem; color: #555;">
            <i class="fas fa-calendar-alt"></i>
            <?php echo e($event->event_date ? $event->event_date->format('F d, Y') : ''); ?>

            &nbsp; | &nbsp;
            <i class="fas fa-map-marker-alt"></i>
            <?php echo e($event->venue ?? 'TBA'); ?>

          </div>
          <div class="event-content mb-3" style="font-size: 1.15rem; color: #222;">
            <?php echo nl2br(e($event->description)); ?>

          </div>
        </div>
      </div>
      <!-- Removed duplicate event description and back button -->
    </div>
    <div class="col-lg-4">
      <?php
        $recentEvents = \App\Models\Event::where('event_date', '<', now())->where('id', '!=', $event->id)->orderBy('event_date', 'desc')->limit(5)->get();
        $upcomingEvents = \App\Models\Event::where('event_date', '>=', now())->where('id', '!=', $event->id)->orderBy('event_date', 'asc')->limit(5)->get();
      ?>
      <div class="event-sidebar">
        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
          <button id="recentTab" class="btn btn-sm" style="background: #facc15; color: #222; font-weight: 700; border-radius: 6px;" onclick="showEvents('recent')">Recent Events</button>
          <button id="upcomingTab" class="btn btn-sm" style="background: #facc15; color: #222; font-weight: 700; border-radius: 6px;" onclick="showEvents('upcoming')">Upcoming Events</button>
        </div>
        <div id="recentEventsList">
          <div class="event-sidebar-title">Recent Events</div>
          <ul class="event-sidebar-list">
            <?php $__empty_1 = true; $__currentLoopData = $recentEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <li><a href="<?php echo e(route('events.show', $recent->id)); ?>"><?php echo e($recent->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <li>No recent events.</li>
            <?php endif; ?>
          </ul>
        </div>
        <div id="upcomingEventsList" style="display:none;">
          <div class="event-sidebar-title">Upcoming Events</div>
          <ul class="event-sidebar-list">
            <?php $__empty_1 = true; $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upcoming): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <li><a href="<?php echo e(route('events.show', $upcoming->id)); ?>"><?php echo e($upcoming->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <li>No upcoming events.</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
      <script>
        function showEvents(type) {
          document.getElementById('recentEventsList').style.display = (type === 'recent') ? '' : 'none';
          document.getElementById('upcomingEventsList').style.display = (type === 'upcoming') ? '' : 'none';
          document.getElementById('recentTab').style.background = (type === 'recent') ? '#facc15' : '#f3f4f6';
          document.getElementById('recentTab').style.color = (type === 'recent') ? '#222' : '#222';
          document.getElementById('upcomingTab').style.background = (type === 'upcoming') ? '#facc15' : '#f3f4f6';
          document.getElementById('upcomingTab').style.color = (type === 'upcoming') ? '#222' : '#222';
        }
      </script>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.alumni', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\alumni system\resources\views/events/show.blade.php ENDPATH**/ ?>