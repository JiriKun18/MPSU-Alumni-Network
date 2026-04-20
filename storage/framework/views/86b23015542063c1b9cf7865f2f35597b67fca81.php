
<?php $__env->startSection('title','Events'); ?>
<?php $__env->startSection('content'); ?>
<style>
.event-card {
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(26, 71, 42, 0.08);
    overflow: hidden;
    border: 1px solid #e2e8f0;
    margin-bottom: 2rem;
    background: #fff;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.event-card-header {
    background: #093b1a;
    color: #fff;
    padding: 0.5rem 1.25rem 1.25rem 1.25rem;
    min-height: 120px;
    position: relative;
}
/* Event image styling */
.event-image {
  width: 100%;
  height: 120px;
  object-fit: cover;
  border-radius: 8px 8px 0 0;
  margin-bottom: 0.5rem;
}
.event-card-header h3 {
    font-size: 1.35rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #fff;
}
.event-card-header .event-meta {
    font-size: 1rem;
    color: #ffd700;
    font-weight: 600;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.event-card-body {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.event-card-body p {
    color: #222;
    font-size: 1.05rem;
    margin-bottom: 1.5rem;
}
.event-card-footer {
    padding: 1rem 1.25rem;
    background: #fff;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: flex-end;
}
.event-read-more {
    background: #14532d;
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 4px;
    padding: 0.5rem 1.5rem;
    font-size: 1rem;
    transition: background 0.2s;
}
.event-read-more:hover {
    background: #166534;
    color: #ffd700;
}
</style>
<div class="container">
  <h1 class="mb-4" style="font-weight: 800; color: #093b1a;">Events</h1>
  <div class="row">
    <div class="col-lg-8">
      <?php if($events->count()): ?>
        <div class="row g-4">
          <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-6 d-flex">
              <div class="event-card w-100">
                  <?php if(!empty($event->image)): ?>
                    <img src="<?php echo e(asset('storage/' . $event->image)); ?>" alt="<?php echo e($event->title); ?>" class="event-image mb-2" />
                  <?php else: ?>
                    <div style="height: 120px; background: linear-gradient(135deg, var(--primary-color) 0%, #1a6b3d 100%); display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-calendar-alt fa-2x" style="color: rgba(255,255,255,0.3);"></i>
                    </div>
                  <?php endif; ?>
                  <div class="event-card-header">
                    <h3><?php echo e($event->title); ?></h3>
                    <div class="event-meta">
                      <i class="fas fa-calendar-alt"></i>
                      <?php echo e($event->event_date ? $event->event_date->format('F d, Y') : ''); ?>

                    </div>
                    <div class="event-meta">
                      <i class="fas fa-map-marker-alt"></i>
                      <?php echo e($event->venue ?? 'TBA'); ?>

                    </div>
                  </div>
                <div class="event-card-body">
                  <p><?php echo e(Str::limit($event->description, 220)); ?></p>
                </div>
                <div class="event-card-footer">
                  <a href="<?php echo e(route('events.show', $event->id)); ?>" class="event-read-more">READ MORE <i class="fas fa-angle-double-right"></i></a>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-4">
          <?php echo e($events->links()); ?>

        </div>
      <?php else: ?>
        <div class="alert alert-info">No events found.</div>
      <?php endif; ?>
    </div>
    <div class="col-lg-4">
      <div class="card" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: none;">
        <div class="card-body">
          <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <button id="recentTab" class="btn btn-sm" style="background: #facc15; color: #222; font-weight: 700; border-radius: 6px;" onclick="showEvents('recent')">Recent Events</button>
            <button id="upcomingTab" class="btn btn-sm" style="background: #facc15; color: #222; font-weight: 700; border-radius: 6px;" onclick="showEvents('upcoming')">Upcoming Events</button>
          </div>
          <div id="recentEventsList">
            <h4 style="font-weight: 800; color: #222; border-bottom: 2px solid #facc15; padding-bottom: 0.5rem; margin-bottom: 1rem;">Recent Events</h4>
            <?php $__currentLoopData = $recentEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div style="margin-bottom: 1rem;">
                <a href="<?php echo e(route('events.show', $event->id)); ?>" class="sidebar-event-link" style="color: #222; font-weight: 600; text-decoration: none;"><?php echo e($event->title); ?></a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <div id="upcomingEventsList" style="display:none;">
            <h4 style="font-weight: 800; color: #222; border-bottom: 2px solid #facc15; padding-bottom: 0.5rem; margin-bottom: 1rem;">Upcoming Events</h4>
            <?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div style="margin-bottom: 1rem;">
                <a href="<?php echo e(route('events.show', $event->id)); ?>" class="sidebar-event-link" style="color: #222; font-weight: 600; text-decoration: none;"><?php echo e($event->title); ?></a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
      <style>
        .sidebar-event-link:hover {
          color: #facc15 !important;
        }
      </style>
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

<?php echo $__env->make('layouts.alumni', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\alumni system\resources\views/events/index.blade.php ENDPATH**/ ?>