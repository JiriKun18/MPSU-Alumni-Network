<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>MPSU Alumni Network</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo_mpsu.png')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d4d2d;
            --secondary-color: #1a6b3d;
            --accent-gold: #d4af37;
            --accent-gold-light: #e6c758;
            --bg-light: #f5f7f0;
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            scroll-behavior: smooth;
        }

        /* Top contact bar */
        .top-contact-bar {
            background: white;
            padding: 0.75rem 0;
            border-bottom: 2px solid var(--accent-gold);
        }

        .contact-info {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 2rem;
            font-size: 0.95rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .contact-info > div {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contact-info i {
            color: var(--accent-gold);
        }

        .btn-update-profile {
            background: var(--accent-gold);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-update-profile:hover {
            background: var(--accent-gold-light);
            transform: translateY(-2px);
        }

        /* Premium Navigation */
        .navbar-premium {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 20px rgba(13, 77, 45, 0.15);
            border-bottom: 3px solid var(--accent-gold);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand-premium {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white !important;
            font-weight: 800;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .navbar-brand-premium img {
            height: 70px;
            width: 70px;
            border-radius: 10px;
            background: white;
            padding: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-brand-text .brand-main {
            font-size: 1rem;
            font-weight: 700;
        }

        .navbar-brand-text .brand-sub {
            font-size: 0.85rem;
            font-weight: 600;
            opacity: 0.95;
        }

        .navbar-link-premium {
            color: var(--accent-gold) !important;
            font-weight: 600;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0 0.25rem;
            font-size: 0.95rem;
        }

        .navbar-link-premium:hover {
            color: white !important;
            background: rgba(212, 175, 55, 0.2);
            transform: translateY(-2px);
        }

        .navbar-divider {
            border-left: 2px solid rgba(212, 175, 55, 0.4);
            height: 25px;
            margin: 0 0.5rem;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(13, 77, 45, 0.85) 0%, rgba(26, 107, 61, 0.85) 100%), 
                        url('<?php echo e(asset('images/logo_mpsu.png')); ?>') center/cover;
            color: white;
            padding: 6rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="dots" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="1200" height="600" fill="url(%23dots)"/></svg>');
            opacity: 0.3;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(212, 175, 55, 0.2);
            color: var(--accent-gold);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            border: 1px solid var(--accent-gold);
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            letter-spacing: -2px;
            margin-bottom: 1rem;
            line-height: 1;
        }

        .hero-year {
            font-size: 5rem;
            font-weight: 900;
            color: var(--accent-gold);
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.95;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-weight: 500;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .btn-premium {
            padding: 0.8rem 1.8rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-premium-primary {
            background: var(--accent-gold);
            color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .btn-premium-primary:hover {
            background: var(--accent-gold-light);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
            transform: translateY(-3px);
        }

        .btn-premium-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
        }

        .btn-premium-secondary:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        .hero-stats {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--accent-gold);
        }

        .hero-stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.25rem;
        }

        /* Features Section */
        .features-section {
            padding: 6rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--primary-color);
            margin-bottom: 1rem;
            text-align: center;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            text-align: center;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid transparent;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-gold);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--accent-gold);
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        .feature-card a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .feature-card a:hover {
            color: var(--accent-gold);
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 4rem 0;
            margin: 2rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            color: var(--accent-gold);
            line-height: 1;
        }

        .stat-label {
            font-size: 1.1rem;
            margin-top: 0.5rem;
            opacity: 0.95;
            font-weight: 500;
        }

        /* CTA Section */
        .cta-section {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            text-align: center;
            box-shadow: var(--shadow-lg);
            margin: 3rem 0;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .cta-text {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Footer */
        .footer-premium {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
            border-top: 3px solid var(--accent-gold);
            text-align: center;
        }

        .footer-premium p {
            margin: 0;
            opacity: 0.9;
        }

        .restricted-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-gold-light) 100%);
            color: var(--primary-color);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-premium {
                width: 100%;
                justify-content: center;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Top Contact Bar -->
    <div class="top-contact-bar">
        <div class="container-fluid">
            <div class="contact-info">
                
                <div>
                    <i class="fas fa-envelope"></i>
                    mpsu.alumni@gmail.com
                </div>
                
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-premium navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand-premium" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('images/logo_mpsu.png')); ?>" alt="MPSU Logo">
                <div class="navbar-brand-text">
                    <div class="brand-main">Mountain Province State University</div>
                    <div class="brand-sub">Alumni Network</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="background: rgba(212, 175, 55, 0.3); border: none;">
                <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 30 30%22%3E%3Cpath stroke=%22rgba(212, 175, 55, 1)%22 stroke-linecap=%22round%22 stroke-miterlimit=%2210%22 stroke-width=%222%22 d=%22M4 7h22M4 15h22M4 23h22%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: center;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto d-flex align-items-center">
                    <a href="https://mpsu.edu.ph/?page_id=135" class="navbar-link-premium" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-university"></i> About MPSU
                    </a>
                    <a href="#features" class="navbar-link-premium">
                        <i class="fas fa-star"></i> Features
                    </a>
                    <a href="#how-it-works" class="navbar-link-premium">
                        <i class="fas fa-info-circle"></i> How It Works
                    </a>
                    <div class="navbar-divider"></div>
                    <a href="<?php echo e(route('login')); ?>" class="navbar-link-premium" style="background: rgba(212, 175, 55, 0.25); border-radius: 6px; padding: 0.4rem 0.8rem !important;">
                        <i class="fas fa-user"></i> Get in touch Alumni
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                
                <h1 class="hero-title">Mountain Province State University</h1>
                <div class="hero-year">Alumni Network</div>
                <p class="hero-subtitle">
                    Connecting Mountain Province State University graduates Nationwide. Access exclusive opportunities, reconnect with classmates, and stay engaged with your alma mater.
                </p>
                <div class="hero-buttons">
                    <a href="<?php echo e(route('signup.step1')); ?>" class="btn-premium btn-premium-primary">
                        <i class="fas fa-user-plus"></i> Join the Network
                    </a>
                    <a href="<?php echo e(route('login')); ?>" class="btn-premium btn-premium-secondary">
                        <i class="fas fa-sign-in-alt"></i> Sign In
                    </a>
                </div>
                <?php
                    $registeredUsers = 0;
                    $jobsOffered = 0;
                    $totalEvents = 0;

                    try {
                        $registeredUsers = \App\Models\User::count();
                        $jobsOffered = \App\Models\JobPosting::where('is_active', true)
                            ->where('approval_status', 'approved')
                            ->count();
                        $totalEvents = \App\Models\Event::count();
                    } catch (\Throwable $e) {
                        // Keep homepage available even if database is temporarily unreachable.
                    }

                    $yearsLegacy = now()->year - 1969;
                ?>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-number"><?php echo e(number_format($registeredUsers)); ?></div>
                        <div class="hero-stat-label">Alumni Connected</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number"><?php echo e(number_format($jobsOffered)); ?></div>
                        <div class="hero-stat-label">Jobs Offered</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number"><?php echo e($yearsLegacy); ?></div>
                        <div class="hero-stat-label">Years Legacy</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                
            </div>
        </div>
    </section>
            </div>
        </div>
    </section>

    <!-- About MPSU Section -->
    <section id="about" class="features-section" style="background: white; padding: 6rem 0; scroll-margin-top: 80px;">
        <div class="container">
            <h2 class="section-title">About Mountain Province State University</h2>
            <p class="section-subtitle">Excellence in Education Since 1969</p>
            
            <div class="mb-5">
                <div style="padding: 2rem; background: linear-gradient(135deg, rgba(26, 71, 42, 0.05) 0%, rgba(74, 124, 44, 0.05) 100%); border-radius: 16px; border-left: 4px solid var(--accent-gold);">
                    <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                        <i class="fas fa-university"></i> Our History
                    </h3>
                    <div id="historyPreview">
                        <p style="color: var(--text-secondary); margin-bottom: 1rem; line-height: 1.8;">
                            The Mountain Province State University (MPSU), formerly known as Mountain Province State Polytechnic College (MPSPC), traces its roots to the Mountain Province Community College (MPCC). MPCC was established through Mountain Province Provincial Board Resolution No. 158, signed on April 10, 1969, laying the foundation for higher education in the province.
                        </p>
                        <p style="color: var(--text-secondary); margin-bottom: 1rem; line-height: 1.8;">
                            The institution has undergone significant transformations over the decades, evolving from a community college to a state polytechnic college, and finally achieving university status in 2024. This milestone reflects the institution's unwavering commitment to academic excellence, institutional development, and service to the community.
                        </p>
                    </div>
                    <div id="historyFull" style="display: none;">
                        <p style="color: var(--text-secondary); margin-bottom: 1rem; line-height: 1.8;">
                            The Mountain Province State University (MPSU), formerly known as Mountain Province State Polytechnic College (MPSPC), traces its roots to the Mountain Province Community College (MPCC). MPCC was established through Mountain Province Provincial Board Resolution No. 158, signed on April 10, 1969, laying the foundation for higher education in the province.

The resolution authorized the provincial government of Mountain Province to establish the Mountain Province Community College (MPCC), allocate funds for its initial operations, and form an ad-interim Board of Trustees. The Board was chaired by Governor Alfredo G. Lamen, with Vice-Governor Jaime K. Gomez serving as Vice Chairman. Other members included Superintendent of Schools Raymundo de Leon, Provincial Secretary Timothy Chaokas, Atty. Guillermo Bandonil, Mr. Alfredo G. Pacyaya, and Mr. Alfredo Belingon. After constituting the Board, some of its members were appointed to serve as the first administrative officials of the College. Vice Governor Jaime K. Gomez was designated as Honorary President, Mr. Timothy Chaokas as Executive Director and Registrar, and Mr. Alexander Sumedca and Mr. Alfredo Belingon as part-time administrative and supervisory assistants. Their leadership played a crucial role in establishing the foundation for MPCC’s early development and operations.

On May 14, 1969, the national government, through the Secretary of the Department of Education, formally recognized the establishment of Mountain Province Community College (MPCC). Following this recognition, the MPCC administration was directed to commence its initial course offerings in July 1969, marking the official start of the College’s academic operations.

The governance of the Mountain Province Community College (MPCC) was entrusted to a Board of Directors, led by the Provincial Governor. The first Chairman of the Board was Governor Jaime K. Gomez, under whose leadership the Board not only formulated policies but also took on the critical responsibility of securing financial support for the institution. Given the limited resources available, the College primarily relied on student fees to cover its operating expenses. However, these funds were insufficient to fully sustain the institution’s growing needs, posing financial challenges in its early years.

This financial challenge motivated key individuals to advocate for the conversion of Mountain Province Community College (MPCC) into a state college to ensure better funding and sustainability. As early as 1975, Regional Director Telesforo Boquiren and Assistant Regional Director Bernardo M. Reyes took the initiative by submitting proposals to Secretary Juan Manuel of the Ministry of Education and Culture. However, despite their efforts, the proposals did not yield positive results at the time.

In 1978, during the first election for the Batasang Pambansa, Hon. Victor S. Dominguez was elected as one of the assemblymen representing Region I. Recognizing the need for greater institutional support, he sought to file a bill for the conversion of Mountain Province Community College (MPCC) into a state college. However, his efforts were hindered by a moratorium imposed by the national government, which restricted the establishment of additional state colleges across the country at that time.

It was only after the reorganization of the Congress of the Philippines in 1987 that efforts to convert Mountain Province Community College (MPCC) into a state college gained momentum. Following his re-election, Hon. Victor S. Dominguez promptly filed House Bill No. 00180, but it did not prosper that year. Undeterred, he continued his advocacy, and on May 28, 1991, he introduced another bill entitled:

“An Act Converting the Mountain Province Community College to be known as the Mountain Province State Polytechnic College, Integrating therewith the Tadian School of Arts and Trades in the Municipality of Tadian; the Bacarri Agricultural High School in the Municipality of Paracelis; and the Eastern Bontoc National Agricultural School in the Municipality of Barlig, all in Mountain Province, and Appropriating Funds thereof.”

The bill underwent legislative processes, receiving its First Reading on June 3, 1991, Second Reading approval on August 15, 1991, and Third Reading approval on September 4, 1991. On January 17, 1992, it was officially enacted by the President of the Republic of the Philippines as Republic Act No. 7182, marking a significant milestone in the institution’s transformation into the Mountain Province State Polytechnic College (MPSPC).

The enactment of Republic Act No. 7182 marked the realization of a long-cherished dream—the establishment of a state college in Mountain Province. This achievement was the result of the relentless dedication and perseverance of the pioneers who took on the arduous task of nurturing and transforming the institution. Their unwavering commitment laid the foundation for what would become a beacon of higher education in the region.

Building on the legacy of their predecessors, succeeding administrators, stakeholders, employees, and students continued to strengthen and advance the institution. Their collective efforts paved the way for further development, culminating in the early stages of applying for university status in 2009.

As part of this initiative, House Bill No. 6392, titled “An Act Elevating MPSPC into a University of Montañosa,” was filed by Hon. Manuel S. Agyao, who was serving as the Caretaker-Congressman for Mountain Province following the untimely demise of Hon. Victor S. Dominguez. The bill gained traction and was approved and passed through the Committee on Higher and Technical Education, marking a significant step toward the institution’s eventual elevation to university status.

In 2010, the proposed legislation underwent revisions and was renamed House Bill 7141, which explicitly stated the act of converting Mountain Province State Polytechnic College (MPSPC) into a university to be known as the Mountain Province State University (MPSU). This marked a crucial step in the institution’s journey toward achieving full university status.

In 2012, the push for university status was revived by Hon. Maximo B. Dalog and Hon. Edgardo M. Angara, who filed House Bill 4449, titled “An Act Converting MPSPC into a State University.” This bill sought to formally elevate Mountain Province State Polytechnic College (MPSPC) to a state university.

On May 24, 2013, His Excellency, President Benigno Simeon Aquino III signed the bill into law, marking another milestone in the institution’s history. However, the law included a provision stating that the conversion into a university would only take effect upon certification by the Commission on Higher Education (CHED), confirming that the institution had substantially complied with the operational requirements for university status.

Following the enactment of Republic Act No. 7182, the Board of Trustees elected D. Marcelino T. Delson as the first College President, serving from 1992 to 2004. His leadership was followed by NEDA-CAR Director Juan B. Ngalob, who was appointed as Officer-in-Charge (OIC) President from August 2004 to March 2005.

In April 2005, Dr. Nieves A. Dacyon was elected as College President, a position she held until November 30, 2012. Upon the conclusion of her term, the Governing Board designated Dr. Geraldine L. Madjaco as OIC College President from December 1, 2012, to March 18, 2013.

Dr. Eufemia C. Lamen was then elected as College President, assuming office on March 19, 2013. However, her tenure was tragically cut short due to her untimely passing in a car accident on December 1, 2013, after only eight months in office. To fill the leadership vacancy, the Board of Trustees appointed Dr. Josephine M. Ngodcho, then Vice President for Academic Affairs, as OIC College President, effective December 6, 2013.

On July 25, 2014, Dr. Rexton F. Chakas was elected as College President by the Board of Trustees, officially assuming leadership of the institution. He served in this capacity until July 25, 2022.

During his administration, Dr. Chakas spearheaded significant investments in infrastructure development, focusing on the improvement of teaching and learning facilities to enhance the overall academic environment. His leadership also prioritized the advancement of accreditation programs, government recognitions, and ISO certification for administrative and support services. Moreover, his tenure played a pivotal role in strengthening the College’s bid for university status, laying the groundwork for its eventual transition into a state university.

The incumbent President, Dr. Edgar G. Cue, assumed office as College President on September 23, 2022. One of his primary goals has been the conversion of the College into a university, a vision that has driven his administration’s initiatives and strategic efforts.

Under his leadership, the institution has placed quality and excellence at the forefront, with a strong emphasis on instruction, research, extension, and resource generation. His administration continues to build upon past achievements, ensuring that the institution meets the highest standards in higher education and institutional development.

At present, the College operates across multiple geographical locations, ensuring broader accessibility to quality education. Its campuses include the Bontoc Campus and the Tadian Campus, with an extension campus in Paracelis, which serves as an extension class of the Tadian Campus, primarily catering to the College of Agriculture. Additionally, the institution manages the Victor S. Dominguez Research and Extension Development Center, located in Ba-ang, Bauko, Mountain Province, reinforcing its commitment to research, extension, and community development.

For the past thirty (30) years since its establishment as a State College in 1992, Mountain Province State Polytechnic College (MPSPC) has remained steadfast in its commitment to providing quality education. Throughout its journey, the institution has undergone various phases of development, continuously evolving to meet academic, institutional, and societal demands.

MPSPC remains dedicated to innovation and progress, ensuring that it proactively responds to the changing needs of the times and the expectations of its stakeholders. At present, the institution faces several key challenges, including:

Program compliance and accreditation, ensuring that academic offerings meet national and international standards.
Compliance with international quality management standards, further enhancing institutional credibility and efficiency.
Infrastructure and facilities development, addressing the growing need for modernized and well-equipped learning environments.
Dr. Edgar G. Cue’s administration worked tirelessly and with unwavering dedication to achieve the long-awaited conversion of the College into a University. Through strategic initiatives, relentless perseverance, and a steadfast commitment to institutional growth, his leadership played a pivotal role in realizing this milestone.

In 2024, his administration’s efforts came to fruition, marking a historic moment as the College officially transitioned into a university. Such transition also made him the first University President of MPSU, and the last College President. This achievement stands as a testament to the collective determination of the institution’s leaders, faculty, staff, and stakeholders, who all shared the vision of advancing higher education in the region.

The transition of Mountain Province State Polytechnic College (MPSPC) to Mountain Province State University (MPSU) marks a historic milestone in the educational landscape of the region. This momentous transformation was officially approved by the Commission on Higher Education (CHED) on August 27, 2024, following the enactment of Republic Act No. 12016, which was signed into law by President Ferdinand Marcos Jr. on August 1, 2024.

The successful conversion was the result of rigorous evaluations conducted by CHED’s Composite Team, which thoroughly assessed key institutional criteria such as student enrollment, academic program offerings, faculty qualifications, research initiatives, learning resources, and community outreach programs. This milestone reflects the institution’s unwavering commitment to academic excellence, institutional development, and service to the community, ensuring that MPSU continues to thrive as a leading higher education institution in the region.

                        </p>
                    </div>
                    <div style="text-align: center; margin-top: 1.5rem;">
                        <button id="readMoreBtn" onclick="toggleHistory()" style="padding: 0.75rem 2rem; border-radius: 8px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                            <i class="fas fa-chevron-down" id="readMoreIcon"></i> <span id="readMoreText">Read Full History</span>
                        </button>
                    </div>
                    <p style="color: var(--text-secondary); line-height: 1.8; margin-top: 2rem;">
                        The university is committed to providing accessible, relevant, and quality higher education through instruction, research, extension, and production services.
                    </p>
                </div>
            </div>

            <!-- Vision & Mission -->
            <div class="row align-items-stretch mb-4">
                <div class="col-lg-6 mb-4">
                    <div style="padding: 2rem; background: white; border-radius: 16px; box-shadow: var(--shadow-md); border-top: 4px solid var(--primary-color); height: 100%;">
                        <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                            <i class="fas fa-eye"></i> Vision
                        </h3>
                        <p style="color: var(--text-secondary); line-height: 1.8; font-size: 1.05rem;">
                            A unique highland coffee university, culturally and innovatively centric, globally recognized that transforms quality of life.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div style="padding: 2rem; background: white; border-radius: 16px; box-shadow: var(--shadow-md); border-top: 4px solid var(--secondary-color); height: 100%;">
                        <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                            <i class="fas fa-bullseye"></i> Mission
                        </h3>
                        <p style="color: var(--text-secondary); line-height: 1.8; font-size: 1.05rem;">
                            A pioneering university embracing a leadership role in shaping human capital, culturally rooted and innovatively directed.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Primary Goal -->
            <div class="mb-4">
                <div style="padding: 2rem; background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(212, 175, 55, 0.05) 100%); border-radius: 16px; border-left: 4px solid var(--accent-gold);">
                    <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                        <i class="fas fa-trophy"></i> Primary Goal
                    </h3>
                    <p style="color: var(--text-secondary); line-height: 1.8; font-size: 1.05rem;">
                        To transform MPSU into a culture-based educational institution inspired by the exercise of its academic freedom; empowered by its sense of cultural pride, to produce graduates who will excel and compete in this changing world.
                    </p>
                </div>
            </div>

            <!-- Strategic Pillars -->
            <div class="mb-4">
                <div style="padding: 2rem; background: white; border-radius: 16px; box-shadow: var(--shadow-md); border-top: 4px solid var(--accent-gold);">
                    <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                        <i class="fas fa-columns"></i> Strategic Pillars: MPSU
                    </h3>
                    <div style="color: var(--text-secondary); line-height: 1.8;">
                        <div style="margin-bottom: 1.5rem;">
                            <strong style="color: var(--primary-color); font-size: 1.1rem;">M – MPSU as a Hub of:</strong>
                            <ul style="margin-top: 0.5rem; margin-left: 1.5rem;">
                                <li>Academic enhancement</li>
                                <li>Research and translational areas</li>
                                <li>Technological innovation</li>
                                <li>Technology incubator entrepreneurship and commercialization</li>
                                <li>Environmental stewardship</li>
                            </ul>
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <strong style="color: var(--primary-color); font-size: 1.1rem;">P – Pioneering Highland Coffee Branding</strong>
                            <p style="margin-top: 0.5rem; font-style: italic;">"The Arabica Coffee of Mountain Province"</p>
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <strong style="color: var(--primary-color); font-size: 1.1rem;">S – Strong and passionate MPSU educational leadership and management</strong>
                            <p style="margin-top: 0.5rem;">For culturally based education, as an engine for graduate's competitive edge.</p>
                        </div>
                        <div>
                            <strong style="color: var(--primary-color); font-size: 1.1rem;">U – United and Committed Academic Community</strong>
                            <p style="margin-top: 0.5rem;">For the University's leadership role as a pioneering state university.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thrusts: TRANSFORM -->
            <div class="mb-4">
                <div style="padding: 2rem; background: linear-gradient(135deg, rgba(26, 71, 42, 0.05) 0%, rgba(74, 124, 44, 0.05) 100%); border-radius: 16px; border-left: 4px solid var(--secondary-color);">
                    <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                        <i class="fas fa-rocket"></i> Thrusts: TRANSFORM
                    </h3>
                    <div class="row" style="color: var(--text-secondary);">
                        <div class="col-md-6 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">T –</strong>
                                <span>Transformational curriculum and instruction</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">R –</strong>
                                <span>Relevant production and sustainable resources generation programs</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">A –</strong>
                                <span>Accessible and equitable learning resources and student services and development</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">N –</strong>
                                <span>Noteworthy partnerships and extension services</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">S –</strong>
                                <span>Sustainable Development Goals integrated into programs, projects, and activities</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">F –</strong>
                                <span>Functional leadership</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">O –</strong>
                                <span>Organizational strengthening toward efficient delivery of services</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">R –</strong>
                                <span>Responsive local and global linkages</span>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div style="display: flex; gap: 0.75rem;">
                                <strong style="color: var(--accent-gold);">M –</strong>
                                <span>Modern research-based solutions and responsive, innovative Technologies</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Core Values -->
            <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); border-radius: 16px; padding: 3rem 2rem; margin-bottom: 3rem;">
                <h3 style="color: white; font-weight: 700; text-align: center; margin-bottom: 2rem;">
                    <i class="fas fa-heart"></i> Core Values: PRIME
                </h3>
                <div class="row text-center">
                    <div class="col-md-2 col-6 mb-3">
                        <div style="padding: 1rem;">
                            <div style="font-size: 2.5rem; color: var(--accent-gold); margin-bottom: 0.5rem;">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h5 style="color: white; font-weight: 600;">Professionalism</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div style="padding: 1rem;">
                            <div style="font-size: 2.5rem; color: var(--accent-gold); margin-bottom: 0.5rem;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h5 style="color: white; font-weight: 600;">Resiliency</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div style="padding: 1rem;">
                            <div style="font-size: 2.5rem; color: var(--accent-gold); margin-bottom: 0.5rem;">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 style="color: white; font-weight: 600;">Inclusivity</h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div style="padding: 1rem;">
                            <div style="font-size: 2.5rem; color: var(--accent-gold); margin-bottom: 0.5rem;">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h5 style="color: white; font-weight: 600;">Moral Integrity</h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div style="padding: 1rem;">
                            <div style="font-size: 2.5rem; color: var(--accent-gold); margin-bottom: 0.5rem;">
                                <i class="fas fa-star"></i>
                            </div>
                            <h5 style="color: white; font-weight: 600;">Excellence</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section" style="scroll-margin-top: 80px;">
        <div class="container">
            <h2 class="section-title">System Features & Benefits</h2>
            <p class="section-subtitle">Explore what our alumni network platform has to offer</p>
            
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <h3>Alumni Directory</h3>
                        <p>Search and connect with thousands of MPSU graduates across different batches and courses. View alumni profiles including their current positions, companies, and contact information. Build meaningful professional relationships and expand your network.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3>Job Opportunities</h3>
                        <p>Browse exclusive career opportunities posted by employers and alumni-owned businesses. Apply directly through the platform. Receive notifications about new job postings matching your profile and skills.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3>Events & Reunions</h3>
                        <p>Stay informed about alumni reunions, homecomings, networking sessions, and university activities. Register for events online. Connect with your batch mates and participate in community gatherings.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h3>News & Updates</h3>
                        <p>Get the latest news about the university, alumni achievements, and announcements. Stay connected with what's happening at MPSU and in the alumni community.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Career Tracking</h3>
                        <p>Update your employment status, current position, and company information. Help the university track alumni success and provide better career services to current students.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-poll"></i>
                        </div>
                        <h3>Surveys & Feedback</h3>
                        <p>Participate in tracer studies and surveys. Share your insights and experiences to help improve the university's programs and services for future generations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="features-section" style="background: white; scroll-margin-top: 80px;">
        <div class="container">
            <h2 class="section-title">How to Get Started</h2>
            <p class="section-subtitle">Join our alumni community in three simple steps</p>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card" style="border-top: 4px solid var(--accent-gold);">
                        <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; font-weight: 900;">
                            1
                        </div>
                        <h3>Create Account</h3>
                        <p>Register using your email and verify through OTP. Provide your basic information and graduation details.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card" style="border-top: 4px solid var(--accent-gold);">
                        <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; font-weight: 900;">
                            2
                        </div>
                        <h3>Complete Profile</h3>
                        <p>Fill in your alumni profile with education, employment, and contact information. Add a professional photo.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card" style="border-top: 4px solid var(--accent-gold);">
                        <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; font-weight: 900;">
                            3
                        </div>
                        <h3>Start Networking</h3>
                        <p>Connect with fellow alumni, explore job opportunities, register for events, and stay updated with news.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-premium">
        <div class="container">
            <div class="row" style="text-align: left; padding: 2rem 0;">
                <div class="col-md-4 mb-4">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                        <img src="<?php echo e(asset('images/logo_mpsu.png')); ?>" alt="MPSU Logo" style="height: 40px; width: 40px; border-radius: 8px; background: white; padding: 4px;">
                        <h5 style="margin: 0; font-weight: 700; color: white;">MPSU Alumni Network</h5>
                    </div>
                    <p style="opacity: 0.9; font-size: 0.95rem;">
                        Connecting Mountain Province State University graduates worldwide since 1969.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 style="font-weight: 700; color: var(--accent-gold); margin-bottom: 1rem;">Quick Links</h5>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="https://mpsu.edu.ph/?page_id=135" style="color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i> About MPSU
                        </a>
                        <a href="#features" style="color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">
                            <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i> Features
                        </a>
                        <a href="<?php echo e(route('login')); ?>" style="color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">
                            <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i> Get in touch alumni
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 style="font-weight: 700; color: var(--accent-gold); margin-bottom: 1rem;">Contact Info</h5>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem; opacity: 0.9;">
                        <div>
                            <i class="fas fa-map-marker-alt" style="color: var(--accent-gold); width: 20px;"></i>
                            Bontoc, Mountain Province, Philippines
                        </div>
                        <div>
                            <i class="fas fa-envelope" style="color: var(--accent-gold); width: 20px;"></i>
                            mpsu.alumni@gmail.com
                        </div>
                        <div>
                            <i class="fas fa-globe" style="color: var(--accent-gold); width: 20px;"></i>
                            www.mpsu.edu.ph
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Alumni Statistics -->
            <div style="border-top: 1px solid rgba(255,255,255,0.2); border-bottom: 1px solid rgba(255,255,255,0.2); padding: 2rem 0; margin: 1.5rem 0;">
                <div class="row" style="text-align: center;">
                    <div class="col-md-3 col-6 mb-3 mb-md-0">
                        <div style="color: var(--accent-gold); font-weight: 700; font-size: 1.5rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-users"></i> <?php echo e(number_format($registeredUsers)); ?>

                        </div>
                        <div style="font-size: 0.85rem; opacity: 0.9;">Active Alumni Members</div>
                    </div>
                    <div class="col-md-3 col-6 mb-3 mb-md-0">
                        <div style="color: var(--accent-gold); font-weight: 700; font-size: 1.5rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-briefcase"></i> <?php echo e(number_format($jobsOffered)); ?>

                        </div>
                        <div style="font-size: 0.85rem; opacity: 0.9;">Jobs Offered</div>
                    </div>
                    <div class="col-md-3 col-6 mb-3 mb-md-0">
                        <div style="color: var(--accent-gold); font-weight: 700; font-size: 1.5rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-calendar"></i> <?php echo e(number_format($totalEvents)); ?>

                        </div>
                        <div style="font-size: 0.85rem; opacity: 0.9;">Annual Events</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div style="color: var(--accent-gold); font-weight: 700; font-size: 1.5rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-graduation-cap"></i> <?php echo e($yearsLegacy); ?>

                        </div>
                        <div style="font-size: 0.85rem; opacity: 0.9;">Years Legacy</div>
                    </div>
                </div>
            </div>
            
            <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 1.5rem; text-align: center;">
                <div style="margin-bottom: 1rem;">
                    <a href="<?php echo e(route('privacy-policy')); ?>" style="color: rgba(255,255,255,0.9); text-decoration: none; margin: 0 1rem; font-size: 0.9rem;">Privacy Policy</a>
                    <span style="color: rgba(255,255,255,0.5);">|</span>
                    <a href="<?php echo e(route('terms-of-service')); ?>" style="color: rgba(255,255,255,0.9); text-decoration: none; margin: 0 1rem; font-size: 0.9rem;">Terms of Service</a>
                </div>
                <p style="margin: 0; opacity: 0.9;">&copy; <?php echo e(date('Y')); ?> Mountain Province State University. All rights reserved.</p>
                <p style="font-size: 0.9rem; margin-top: 0.5rem; opacity: 0.8;">MPSU Alumni Network - Connecting Generations of Excellence</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleHistory() {
            const preview = document.getElementById('historyPreview');
            const full = document.getElementById('historyFull');
            const btn = document.getElementById('readMoreBtn');
            const icon = document.getElementById('readMoreIcon');
            const text = document.getElementById('readMoreText');
            
            if (full.style.display === 'none') {
                preview.style.display = 'none';
                full.style.display = 'block';
                icon.className = 'fas fa-chevron-up';
                text.textContent = 'Show Less';
                btn.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                preview.style.display = 'block';
                full.style.display = 'none';
                icon.className = 'fas fa-chevron-down';
                text.textContent = 'Read Full History';
                document.getElementById('about').scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\alumni system\resources\views/welcome.blade.php ENDPATH**/ ?>