

<?php $__env->startSection('title', $article->title); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Fix padding body dari layout utama */
    body {
        padding-top: 0 !important;
    }

    /* ============================================
       HERO MODERN
       ============================================ */
    .article-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        overflow: hidden;
    }

    .article-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .article-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .article-hero .container {
        position: relative;
        z-index: 1;
    }

    /* Breadcrumb */
    .breadcrumb {
        margin-bottom: 16px;
    }

    .breadcrumb-item a {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        font-size: 0.85rem;
        transition: color 0.3s;
    }

    .breadcrumb-item a:hover {
        color: #4EB8CC;
    }

    .breadcrumb-item.active {
        color: rgba(255,255,255,0.9);
        font-size: 0.85rem;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.4);
    }

    /* Category Badge */
    .article-category {
        display: inline-block;
        background: rgba(78,184,204,0.2);
        color: #A8DDE8;
        padding: 5px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.03em;
        border: 1px solid rgba(78,184,204,0.3);
        margin-bottom: 16px;
    }

    .article-hero h1 {
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        color: rgba(255,255,255,0.6);
        font-size: 0.9rem;
    }

    .article-meta span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .article-meta i {
        color: #4EB8CC;
    }

    /* ============================================
       CONTENT SECTION
       ============================================ */
    .article-content-section {
        padding: 60px 0 80px;
        background: #fff;
    }

    .article-main-image {
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
    }

    .article-main-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .article-placeholder-img {
        width: 100%;
        aspect-ratio: 16 / 9;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        margin-bottom: 40px;
    }

    .article-placeholder-img i {
        font-size: 64px;
        color: #0E7A96;
        opacity: 0.3;
    }

    /* ============================================
       ARTICLE CONTENT - SAMA DENGAN DASHBOARD
       ============================================ */
    .article-content {
        color: #334155;
        line-height: 1.9;
        font-size: 1.05rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Heading */
    .article-content h1,
    .article-content h2,
    .article-content h3,
    .article-content h4,
    .article-content h5,
    .article-content h6 {
        color: #0D1B2A;
        font-weight: 700;
        margin-top: 28px;
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .article-content h1 { font-size: 1.8rem; }
    .article-content h2 { font-size: 1.5rem; }
    .article-content h3 { font-size: 1.25rem; }
    .article-content h4 { font-size: 1.1rem; }

    /* Paragraph */
    .article-content p {
        margin-bottom: 20px;
    }

    /* Image */
    .article-content img {
        border-radius: 12px;
        margin: 20px 0;
        max-width: 100%;
        height: auto;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    /* Figure */
    .article-content figure {
        margin: 20px 0;
    }

    .article-content figure img {
        margin: 0;
    }

    .article-content figcaption {
        text-align: center;
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 8px;
        font-style: italic;
    }

    /* Blockquote */
    .article-content blockquote {
        border-left: 4px solid #4EB8CC;
        background: #F8FAFC;
        padding: 20px 24px;
        border-radius: 0 12px 12px 0;
        margin: 24px 0;
        color: #475569;
        font-style: italic;
    }

    .article-content blockquote p {
        margin-bottom: 0;
    }

    /* Link */
    .article-content a {
        color: #0E7A96;
        text-decoration: underline;
        text-underline-offset: 3px;
        transition: color 0.2s;
    }

    .article-content a:hover {
        color: #0A4A60;
    }

    /* List */
    .article-content ul,
    .article-content ol {
        margin-bottom: 20px;
        padding-left: 24px;
    }

    .article-content ul {
        list-style-type: disc;
    }

    .article-content ol {
        list-style-type: decimal;
    }

    .article-content li {
        margin-bottom: 8px;
    }

    .article-content ul ul,
    .article-content ol ol,
    .article-content ul ol,
    .article-content ol ul {
        margin-top: 8px;
        margin-bottom: 0;
    }

    /* Table */
    .article-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
    }

    .article-content table th {
        background: #F1F5F9;
        padding: 12px 16px;
        font-weight: 600;
        color: #0D1B2A;
        border: 1px solid #E2E8F0;
        text-align: left;
    }

    .article-content table td {
        padding: 12px 16px;
        border: 1px solid #E2E8F0;
        color: #334155;
    }

    .article-content table tr:nth-child(even) {
        background: #F8FAFC;
    }

    /* Code */
    .article-content pre {
        background: #1E293B;
        color: #E2E8F0;
        padding: 20px;
        border-radius: 12px;
        overflow-x: auto;
        margin: 20px 0;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .article-content code {
        background: #F1F5F9;
        color: #0E7A96;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.9em;
    }

    .article-content pre code {
        background: none;
        color: inherit;
        padding: 0;
    }

    /* Horizontal Rule */
    .article-content hr {
        border: none;
        border-top: 1px solid #E2E8F0;
        margin: 32px 0;
    }

    /* Text Alignment */
    .article-content .text-left { text-align: left; }
    .article-content .text-center { text-align: center; }
    .article-content .text-right { text-align: right; }
    .article-content .text-justify { text-align: justify; }

    /* Video Embed */
    .article-content iframe {
        max-width: 100%;
        border-radius: 12px;
        margin: 20px 0;
    }

    /* Highlight Box */
    .article-content .highlight-box {
        background: linear-gradient(135deg, rgba(14,122,150,0.08), rgba(78,184,204,0.05));
        border: 1px solid rgba(14,122,150,0.15);
        border-radius: 12px;
        padding: 20px 24px;
        margin: 20px 0;
    }

    /* ============================================
       SHARE SECTION
       ============================================ */
    .share-section {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 1px solid #E2E8F0;
    }

    .share-section h5 {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 16px;
        font-size: 1rem;
    }

    .share-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-share {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.3s;
        border: 1px solid #E2E8F0;
        background: white;
        color: #475569;
    }

    .btn-share:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .btn-share.facebook:hover {
        background: #1877F2;
        color: white;
        border-color: #1877F2;
    }

    .btn-share.twitter:hover {
        background: #000000;
        color: white;
        border-color: #000000;
    }

    .btn-share.whatsapp:hover {
        background: #25D366;
        color: white;
        border-color: #25D366;
    }

    .btn-share.telegram:hover {
        background: #26A5E4;
        color: white;
        border-color: #26A5E4;
    }

    /* ============================================
       RELATED ARTICLES
       ============================================ */
    .related-section {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 1px solid #E2E8F0;
    }

    .related-section h4 {
        font-weight: 800;
        color: #0D1B2A;
        margin-bottom: 24px;
        font-size: 1.3rem;
    }

    .related-card {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        background: white;
        transition: all 0.3s;
        height: 100%;
    }

    .related-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(14,122,150,0.1);
        border-color: #4EB8CC;
    }

    .related-card-img {
        aspect-ratio: 16 / 9;
        overflow: hidden;
    }

    .related-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }

    .related-card:hover .related-card-img img {
        transform: scale(1.05);
    }

    .related-placeholder {
        aspect-ratio: 16 / 9;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .related-placeholder i {
        font-size: 32px;
        color: #0E7A96;
        opacity: 0.3;
    }

    .related-card .card-body {
        padding: 16px;
    }

    .related-card .card-title {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        .article-hero {
            padding: 70px 0 50px;
        }

        .article-content-section {
            padding: 40px 0;
        }

        .article-content {
            font-size: 1rem;
        }

        .article-content h1 { font-size: 1.5rem; }
        .article-content h2 { font-size: 1.3rem; }
        .article-content h3 { font-size: 1.15rem; }

        .article-content table {
            font-size: 0.85rem;
        }

        .article-content table th,
        .article-content table td {
            padding: 8px 12px;
        }

        .share-buttons {
            flex-direction: column;
        }

        .btn-share {
            justify-content: center;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="article-hero">
    <div class="container">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('information.index')); ?>">Informasi</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(Str::limit($article->title, 50)); ?></li>
            </ol>
        </nav>

        
        <span class="article-category"><?php echo e($article->category); ?></span>

        
        <h1><?php echo e($article->title); ?></h1>

        
        <div class="article-meta">
            <span>
                <i class="bi bi-calendar3"></i>
                <?php echo e($article->published_at->format('d M Y')); ?>

            </span>
            <?php if($article->published_at): ?>
            <span>
                <i class="bi bi-clock"></i>
                <?php echo e($article->published_at->diffForHumans()); ?>

            </span>
            <?php endif; ?>
            <span>
                <i class="bi bi-person"></i>
                Admin QofMedia
            </span>
        </div>
    </div>
</section>


<section class="article-content-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                
                <?php if($article->image): ?>
                    <div class="article-main-image">
                        <img src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>" loading="lazy">
                    </div>
                <?php else: ?>
                    <div class="article-placeholder-img">
                        <i class="bi bi-newspaper"></i>
                    </div>
                <?php endif; ?>

                
                <div class="article-content">
                    <?php echo nl2br(e($article->content)); ?>

                </div>

                
                <div class="share-section">
                    <h5><i class="bi bi-share me-2"></i>Bagikan Artikel Ini</h5>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="btn-share facebook">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->url())); ?>&text=<?php echo e(urlencode($article->title)); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="btn-share twitter">
                            <i class="bi bi-twitter-x"></i> Twitter
                        </a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo e(urlencode($article->title . ' ' . request()->url())); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="btn-share whatsapp">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://t.me/share/url?url=<?php echo e(urlencode(request()->url())); ?>&text=<?php echo e(urlencode($article->title)); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="btn-share telegram">
                            <i class="bi bi-telegram"></i> Telegram
                        </a>
                    </div>
                </div>

                
                <?php if($relatedArticles->count() > 0): ?>
                    <div class="related-section">
                        <h4><i class="bi bi-link-45deg me-2"></i>Artikel Terkait</h4>
                        <div class="row g-4">
                            <?php $__currentLoopData = $relatedArticles->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <a href="<?php echo e(route('information.show', $related->slug)); ?>" class="text-decoration-none">
                                        <div class="related-card h-100">
                                            <?php if($related->image): ?>
                                                <div class="related-card-img">
                                                    <img src="<?php echo e(asset('storage/' . $related->image)); ?>" alt="<?php echo e($related->title); ?>" loading="lazy">
                                                </div>
                                            <?php else: ?>
                                                <div class="related-placeholder">
                                                    <i class="bi bi-newspaper"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo e($related->title); ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                
                <div class="text-center mt-5">
                    <a href="<?php echo e(route('information.index')); ?>" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Informasi
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/information/show.blade.php ENDPATH**/ ?>