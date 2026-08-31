<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloom Aesthetic | 日系精緻美妝與光感肌美學誌</title>
    <meta name="description" content="專屬於您的日系精緻美妝展示與個人作品集品牌網站 - 🌸 Bloom Aesthetic Studio">
    
    <!-- 引入 Google Fonts 典雅字型：Noto Serif JP & Plus Jakarta Sans & Zen Maru Gothic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300;400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Zen+Maru+Gothic:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            /* 🌸 日系美妝主題專屬色階 */
            --bg-linen: #fdfbf7;
            --rosewood: #4a353a;
            --rosewood-light: #7e4a52;
            --sakura-light: #f8ecee;
            --sakura-pink: #f5d6d9;
            --pink-accent: #e8b4b8;
            --pink-deep: #d88890;
            --champagne-gold: #d4af37;
            --gold-light: #f4e8c1;
            --text-dark: #332729;
            --text-muted: #8c7075;
            
            --glass-bg: rgba(255, 255, 255, 0.88);
            --glass-border: rgba(232, 180, 184, 0.45);
            --shadow-sm: 0 4px 15px rgba(126, 74, 82, 0.06);
            --shadow-md: 0 10px 30px rgba(126, 74, 82, 0.1);
            --shadow-lg: 0 20px 50px rgba(126, 74, 82, 0.16);

            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 24px;
            --radius-pill: 50px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Noto Serif JP', 'Zen Maru Gothic', Georgia, serif;
            background-color: var(--bg-linen);
            background-image: 
                radial-gradient(circle at 12% 18%, rgba(248, 236, 238, 0.9) 0%, transparent 45%),
                radial-gradient(circle at 88% 82%, rgba(232, 180, 184, 0.35) 0%, transparent 50%);
            background-attachment: fixed;
            color: var(--text-dark);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* 🌸 櫻花動態飄落 Canvas */
        #sakuraCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 10;
        }

        /* ───── App 主容器 ───── */
        .app-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 20;
        }

        /* ───── 頂部 Navigation Header ───── */
        .header {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: 16px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
            position: sticky;
            top: 15px;
            z-index: 100;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--rosewood);
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--sakura-pink) 0%, var(--pink-accent) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--rosewood);
            box-shadow: 0 4px 12px rgba(232, 180, 184, 0.5);
            transition: transform 0.3s ease;
        }

        .brand-logo:hover .brand-icon {
            transform: rotate(15deg) scale(1.08);
        }

        .brand-title {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 2px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--rosewood);
        }

        .brand-subtitle {
            font-size: 11px;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            display: block;
            margin-top: -2px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
        }

        .nav-btn {
            padding: 8px 18px;
            border-radius: var(--radius-pill);
            background: transparent;
            border: 1px solid transparent;
            color: var(--rosewood);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .nav-btn:hover, .nav-btn.active {
            background: var(--sakura-light);
            border-color: var(--pink-accent);
            color: var(--rosewood-light);
            box-shadow: 0 2px 8px rgba(232, 180, 184, 0.3);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-badge-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--sakura-light);
            border: 1px solid var(--pink-accent);
            color: var(--rosewood);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .icon-badge-btn:hover {
            background: var(--pink-accent);
            color: #fff;
            transform: translateY(-2px);
        }

        .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--pink-deep);
            color: white;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ───── Hero 英雄區塊 ───── */
        .hero-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 236, 238, 0.85) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: 48px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            border-radius: var(--radius-pill);
            background: var(--sakura-light);
            border: 1px solid var(--pink-accent);
            color: var(--rosewood-light);
            font-size: 12.5px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .hero-title {
            font-size: 38px;
            font-weight: 700;
            color: var(--rosewood);
            line-height: 1.25;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .hero-title span {
            color: var(--pink-deep);
            position: relative;
        }

        .hero-desc {
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 28px;
        }

        .hero-btns {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .btn-primary {
            padding: 12px 28px;
            border-radius: var(--radius-pill);
            background: linear-gradient(135deg, var(--rosewood-light) 0%, var(--rosewood) 100%);
            color: #fff;
            border: none;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(74, 53, 58, 0.25);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(74, 53, 58, 0.35);
            background: linear-gradient(135deg, var(--pink-deep) 0%, var(--rosewood-light) 100%);
        }

        .btn-outline {
            padding: 12px 24px;
            border-radius: var(--radius-pill);
            background: transparent;
            border: 1px solid var(--pink-accent);
            color: var(--rosewood);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: var(--sakura-light);
            border-color: var(--pink-deep);
            color: var(--rosewood-light);
        }

        /* 英雄 Slider 展演區 */
        .hero-visual {
            position: relative;
            width: 100%;
            height: 340px;
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 2px solid var(--pink-accent);
            box-shadow: var(--shadow-md);
        }

        .hero-slide {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.6s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .slide-overlay-badge {
            position: absolute;
            bottom: 16px;
            left: 16px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            padding: 8px 16px;
            border-radius: var(--radius-pill);
            border: 1px solid var(--pink-accent);
            font-size: 12px;
            color: var(--rosewood);
            font-weight: 600;
        }

        /* ───── 主頁面 layout 三欄/雙欄風格 ───── */
        .main-layout {
            display: grid;
            grid-template-columns: 260px 1fr 300px;
            gap: 24px;
        }

        @media (max-width: 1100px) {
            .main-layout {
                grid-template-columns: 1fr;
            }
            .hero-section {
                grid-template-columns: 1fr;
            }
        }

        /* 左側 Sidebar 選單卡片 */
        .card-sidebar {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            height: fit-content;
        }

        .sidebar-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--rosewood);
            padding-bottom: 10px;
            margin-bottom: 14px;
            border-bottom: 2px solid var(--sakura-pink);
            position: relative;
        }

        .sidebar-title::after {
            content: '🌸';
            position: absolute;
            right: 0;
            top: -2px;
            font-size: 12px;
        }

        .category-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .category-item {
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            background: var(--bg-linen);
            border: 1px solid rgba(232, 180, 184, 0.3);
            color: var(--rosewood);
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.25s ease;
        }

        .category-item:hover, .category-item.active {
            background: linear-gradient(135deg, var(--sakura-light) 0%, var(--sakura-pink) 100%);
            border-color: var(--pink-accent);
            color: var(--rosewood-light);
            padding-left: 18px;
            font-weight: 600;
        }

        /* 訪客/成員計數 Widget */
        .vip-visitor-box {
            margin-top: 20px;
            padding: 16px;
            background: linear-gradient(135deg, #fff 0%, var(--sakura-light) 100%);
            border: 1px solid var(--pink-accent);
            border-radius: var(--radius-sm);
            text-align: center;
            box-shadow: var(--shadow-sm);
        }

        .vip-title {
            font-size: 11px;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .vip-number {
            font-size: 20px;
            font-weight: 700;
            color: var(--rosewood-light);
            margin-top: 4px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* 中央內容區 (美妝產品 Filter & Grid) */
        .content-area {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* 跑馬燈快訊卡片 */
        .ticker-card {
            background: linear-gradient(90deg, var(--sakura-light) 0%, #fff 100%);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-pill);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow-sm);
        }

        .ticker-badge {
            background: var(--pink-deep);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: var(--radius-pill);
            white-space: nowrap;
        }

        .ticker-text {
            font-size: 13px;
            color: var(--rosewood);
            white-space: nowrap;
            overflow: hidden;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        /* 產品展示卡片 */
        .product-card {
            background: #fff;
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--pink-accent);
        }

        .product-img-wrap {
            height: 180px;
            width: 100%;
            position: relative;
            overflow: hidden;
            background: var(--sakura-light);
        }

        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.08);
        }

        .product-badge-tag {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.9);
            color: var(--rosewood-light);
            border: 1px solid var(--pink-accent);
            padding: 3px 8px;
            border-radius: var(--radius-pill);
            font-size: 10.5px;
            font-weight: 600;
        }

        .product-body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-name {
            font-size: 14.5px;
            font-weight: 600;
            color: var(--rosewood);
            margin-bottom: 6px;
            line-height: 1.4;
        }

        .product-subtitle {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .shade-picker {
            display: flex;
            gap: 6px;
            margin-bottom: 12px;
        }

        .shade-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 1.5px solid #fff;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.15);
            cursor: pointer;
            transition: transform 0.2s;
        }

        .shade-dot:hover, .shade-dot.active {
            transform: scale(1.25);
            box-shadow: 0 0 0 2px var(--pink-deep);
        }

        .product-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed rgba(232, 180, 184, 0.3);
        }

        .product-price {
            font-size: 15px;
            font-weight: 700;
            color: var(--rosewood-light);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-quick-view {
            background: var(--sakura-light);
            border: 1px solid var(--pink-accent);
            color: var(--rosewood);
            padding: 5px 12px;
            border-radius: var(--radius-pill);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-quick-view:hover {
            background: var(--pink-accent);
            color: #fff;
        }

        /* ───── 右側 Sidebar (美畫廊 Gallery & 專欄誌) ───── */
        .right-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .gallery-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: 20px;
            box-shadow: var(--shadow-sm);
        }

        .gallery-img-box {
            width: 100%;
            height: 140px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            margin: 10px 0;
            border: 1.5px solid var(--pink-accent);
            position: relative;
        }

        .gallery-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-img-box:hover img {
            transform: scale(1.06);
        }

        .gallery-nav-btns {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 10px;
        }

        .nav-circle-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid var(--pink-accent);
            background: #fff;
            color: var(--rosewood);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-circle-btn:hover {
            background: var(--pink-accent);
            color: #fff;
        }

        /* 最新美粧情報清單 */
        .journal-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .journal-item {
            font-size: 13px;
            color: var(--text-dark);
            padding: 8px 10px;
            border-radius: var(--radius-sm);
            background: #fff;
            border: 1px solid rgba(232, 180, 184, 0.3);
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .journal-item:hover {
            background: var(--sakura-light);
            border-color: var(--pink-accent);
            color: var(--rosewood-light);
            transform: translateX(4px);
        }

        /* ───── Interactive Before/After Skin Texture Slider ───── */
        .comparison-section {
            background: #fff;
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            margin-top: 24px;
        }

        .comparison-container {
            position: relative;
            width: 100%;
            height: 240px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            margin-top: 14px;
        }

        .comp-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .comp-overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 50%;
            overflow: hidden;
            border-right: 3px solid var(--champagne-gold);
        }

        .comp-overlay img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .comp-slider-input {
            position: absolute;
            inset: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: ew-resize;
            z-index: 10;
        }

        /* ───── Modal 模態框與底幕 ───── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(74, 53, 58, 0.45);
            backdrop-filter: blur(8px);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-card {
            background: #fff;
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            width: 90%;
            max-width: 560px;
            padding: 30px;
            box-shadow: var(--shadow-lg);
            position: relative;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-card {
            transform: translateY(0);
        }

        .modal-close-btn {
            position: absolute;
            top: 18px;
            right: 20px;
            font-size: 22px;
            color: var(--rosewood);
            cursor: pointer;
            border: none;
            background: transparent;
        }

        /* ───── 頁尾 Footer ───── */
        .footer {
            margin-top: 50px;
            background: linear-gradient(135deg, var(--rosewood-light) 0%, var(--rosewood) 100%);
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            padding: 40px 30px 24px 30px;
            color: #fff;
            text-align: center;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
            text-align: left;
        }

        .footer-col h4 {
            font-size: 16px;
            color: var(--gold-light);
            margin-bottom: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 13px;
            opacity: 0.85;
        }

        .footer-col a {
            color: #fff;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-col a:hover {
            color: var(--sakura-pink);
        }

        .footer-bottom {
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.15);
            font-size: 12.5px;
            opacity: 0.8;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

    <!-- 🌸 櫻花飄落背景 Canvas -->
    <canvas id="sakuraCanvas"></canvas>

    <div class="app-container">

        <!-- 🌸 長方形上方美妝廣告 Banner -->
        <div style="width:100%; height:125px; border-radius:var(--radius-lg); overflow:hidden; border:1px solid var(--pink-accent); box-shadow:var(--shadow-sm); margin-bottom:20px; background-image:url('upload/top_ad_banner.svg'); background-size:cover; background-position:center;">
        </div>

        <!-- 🌸 Navigation Header -->
        <header class="header">
            <a href="#" class="brand-logo">
                <div class="brand-icon"><i class="fa-solid fa-spa"></i></div>
                <div>
                    <span class="brand-title">BLOOM AESTHETIC</span>
                    <span class="brand-subtitle">日系精緻美妝與光感肌美學誌</span>
                </div>
            </a>

            <nav>
                <ul class="nav-links">
                    <li><button class="nav-btn active" onclick="filterProducts('all')">全系列作品</button></li>
                    <li><button class="nav-btn" onclick="filterProducts('base')">無瑕底妝</button></li>
                    <li><button class="nav-btn" onclick="filterProducts('lip')">日系唇彩</button></li>
                    <li><button class="nav-btn" onclick="filterProducts('skincare')">光水護膚</button></li>
                    <li><button class="nav-btn" onclick="openSkinQuizModal()">肌膚檢測</button></li>
                </ul>
            </nav>

            <div class="header-actions">
                <button class="icon-badge-btn" title="我的珍藏美妝" onclick="openBookmarkModal()">
                    <i class="fa-regular fa-bookmark"></i>
                    <span class="badge" id="bookmarkCount">3</span>
                </button>
                <button class="btn-primary" style="padding: 8px 18px; font-size: 13px;" onclick="openAdminModal()">
                    <i class="fa-solid fa-lock-open" style="margin-right: 6px;"></i> 品牌後台
                </button>
            </div>
        </header>

        <!-- 🌸 Hero Section -->
        <section class="hero-section">
            <div>
                <div class="hero-tag">🌸 2026 SPRING COLLECTION</div>
                <h1 class="hero-title">
                    櫻花光采亮澤<br>
                    <span>極致天生透明感</span>
                </h1>
                <p class="hero-desc">
                    打造宛若第二層肌膚般的自然薄透光澤。專為亞洲肌膚研發之高植萃鎖水配方，綻放由內而外的潤澤好氣色。
                </p>
                <div class="hero-btns">
                    <button class="btn-primary" onclick="filterProducts('base')">探索春季光感系列</button>
                    <button class="btn-outline" onclick="openSkinQuizModal()"><i class="fa-solid fa-wand-magic-sparkles"></i> 測出命定美妝</button>
                </div>
            </div>

            <!-- Hero 輪播展演視覺 -->
            <div class="hero-visual">
                <img src="upload/hero_jbeauty_v2.png" class="hero-slide active" id="slide1" alt="J-Beauty Serum">
                <img src="upload/header_jbeauty_v2.png" class="hero-slide" id="slide2" alt="J-Beauty Collection">
                <img src="upload/gallery_jbeauty_v2.png" class="hero-slide" id="slide3" alt="J-Beauty Blush">
                <div class="slide-overlay-badge"><i class="fa-solid fa-sparkles"></i> 2026 輕透光感大賞首獎</div>
            </div>
        </section>

        <!-- 🌸 主內容區 (三欄佈局) -->
        <main class="main-layout">

            <!-- 左側側邊欄 -->
            <aside class="card-sidebar">
                <h3 class="sidebar-title">美學分類目錄</h3>
                <ul class="category-list">
                    <li class="category-item active" onclick="filterProducts('all')">
                        <span>🌸 全系列 (All Products)</span>
                        <i class="fa-solid fa-angle-right" style="font-size:11px;"></i>
                    </li>
                    <li class="category-item" onclick="filterProducts('base')">
                        <span>✨ 光采底妝 (Base Makeup)</span>
                        <i class="fa-solid fa-angle-right" style="font-size:11px;"></i>
                    </li>
                    <li class="category-item" onclick="filterProducts('lip')">
                        <span>💄 潤澤唇膏 (Lip Color)</span>
                        <i class="fa-solid fa-angle-right" style="font-size:11px;"></i>
                    </li>
                    <li class="category-item" onclick="filterProducts('skincare')">
                        <span>💧 極致水光護膚 (Skincare)</span>
                        <i class="fa-solid fa-angle-right" style="font-size:11px;"></i>
                    </li>
                    <li class="category-item" onclick="openJournalModal('about')">
                        <span>📖 品牌美學故事 (Story)</span>
                        <i class="fa-solid fa-angle-right" style="font-size:11px;"></i>
                    </li>
                </ul>

                <!-- 訪客/貴賓計數器 -->
                <div class="vip-visitor-box">
                    <div class="vip-title">VIP VISITORS COUNTER</div>
                    <div class="vip-number">🌸 12,850 人次</div>
                    <div style="font-size: 11.5px; color: var(--text-muted); margin-top: 4px;">感謝您蒞臨 Bloom 美學誌</div>
                </div>
            </aside>

            <!-- 中央內容區 -->
            <section class="content-area">

                <!-- 跑馬燈卡片 -->
                <div class="ticker-card">
                    <span class="ticker-badge">LATEST NEWS</span>
                    <marquee scrolldelay="110" direction="left" class="ticker-text">
                        🌸 2026 春季櫻花光采亮澤底妝系列全新上市！預約現場尊榮肌膚檢測享限量奢華好禮 &nbsp;&nbsp;|&nbsp;&nbsp; 🌸 全台專櫃同步提供日系透明感妝容教學諮詢
                    </marquee>
                </div>

                <!-- 產品 Grid 展示 -->
                <div class="product-grid" id="productGridContainer">
                    <!-- JS 動態渲染產品卡片 -->
                </div>

                <!-- Texture Before/After 互動示範 -->
                <div class="comparison-section">
                    <h3 class="sidebar-title" style="border-bottom:none; padding-bottom:0;">
                        ✨ 肌膚光感質地對比 (Luminous Texture Finish)
                    </h3>
                    <p style="font-size:13px; color:var(--text-muted);">拖曳下方拉桿，體驗自然裸肌與水感透亮妝感差異：</p>

                    <div class="comparison-container">
                        <img src="upload/hero_jbeauty1.png" class="comp-img" alt="After J-Beauty">
                        <div class="comp-overlay" id="compOverlay">
                            <img src="upload/gallery_jbeauty1.png" alt="Before J-Beauty">
                        </div>
                        <input type="range" min="0" max="100" value="50" class="comp-slider-input" oninput="updateComparison(this.value)">
                    </div>
                </div>

            </section>

            <!-- 右側側邊欄 -->
            <aside class="right-sidebar">

                <!-- 相簿藝廊卡片 -->
                <div class="gallery-card">
                    <h3 class="sidebar-title">日系美學賞析</h3>
                    <div class="gallery-img-box">
                        <img id="galleryImg" src="upload/gallery_jbeauty1.png" alt="Gallery Showcase">
                    </div>
                    <div style="text-align:center; font-size:12.5px; font-weight:600; color:var(--rosewood);" id="galleryCap">
                        櫻花潤澤雙唇系列 #02
                    </div>
                    <div class="gallery-nav-btns">
                        <button class="nav-circle-btn" onclick="prevGallery()"><i class="fa-solid fa-chevron-left"></i></button>
                        <button class="nav-circle-btn" onclick="nextGallery()"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- 美粧情報列表 -->
                <div class="gallery-card">
                    <h3 class="sidebar-title">最新美粧專欄</h3>
                    <ul class="journal-list">
                        <li class="journal-item" onclick="openJournalModal('article1')">
                            <span style="color:var(--pink-deep);">✦</span>
                            <span>換季敏弱肌：日系前導精華保養學</span>
                        </li>
                        <li class="journal-item" onclick="openJournalModal('article2')">
                            <span style="color:var(--pink-deep);">✦</span>
                            <span>打造透亮無瑕底妝的 3 個黃金步驟</span>
                        </li>
                        <li class="journal-item" onclick="openJournalModal('article3')">
                            <span style="color:var(--pink-deep);">✦</span>
                            <span>2026 春季櫻花嫩粉調唇膏評測選購指南</span>
                        </li>
                    </ul>
                </div>

            </aside>

        </main>

        <!-- 🌸 Footer -->
        <footer class="footer">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>BLOOM AESTHETIC</h4>
                    <p style="font-size:13px; opacity:0.85; line-height:1.7;">
                        致力於探索日系保養與彩妝的純粹美學，打造極致無瑕且透亮的自然光感美肌。
                    </p>
                </div>
                <div class="footer-col">
                    <h4>快速導覽</h4>
                    <ul>
                        <li><a href="#" onclick="filterProducts('all')">全系列商品</a></li>
                        <li><a href="#" onclick="filterProducts('base')">光采底妝系列</a></li>
                        <li><a href="#" onclick="filterProducts('skincare')">水光保養學</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>美學專櫃諮詢</h4>
                    <ul>
                        <li>客服時間：Mon - Fri 10:00 - 18:00</li>
                        <li>諮詢信箱：service@bloom-aesthetic.jp</li>
                        <li>工作室據點：台北市大安區美學大道 88 號</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                © 2026 Bloom Aesthetic Studio. All Rights Reserved. 專屬日系美妝美學作品集
            </div>
        </footer>

    </div>

    <!-- 🌸 Modal: 肌膚檢測測驗 (Skin Quiz) -->
    <div class="modal-overlay" id="skinQuizModal">
        <div class="modal-card">
            <button class="modal-close-btn" onclick="closeModal('skinQuizModal')">✕</button>
            <h3 style="font-size:20px; color:var(--rosewood); margin-bottom:6px;">🌸 個人日系命定光感肌檢測</h3>
            <p style="font-size:13px; color:var(--text-muted); margin-bottom:20px;">回答 2 個簡短問題，系統將為您推薦最適合的 J-Beauty 美妝作品：</p>

            <div style="margin-bottom:20px;">
                <label style="font-size:14px; font-weight:600; color:var(--rosewood); display:block; margin-bottom:8px;">1. 您的主要膚質需求為？</label>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                    <button class="btn-outline" style="text-align:left; font-size:13px;" onclick="selectQuiz(1, 'dry')">💧 保濕補水水感肌</button>
                    <button class="btn-outline" style="text-align:left; font-size:13px;" onclick="selectQuiz(1, 'oily')">✨ 控油零毛孔霧感肌</button>
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <label style="font-size:14px; font-weight:600; color:var(--rosewood); display:block; margin-bottom:8px;">2. 偏好的妝容質感？</label>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                    <button class="btn-outline" style="text-align:left; font-size:13px;" onclick="selectQuiz(2, 'natural')">🌸 自然清透粉嫩感</button>
                    <button class="btn-outline" style="text-align:left; font-size:13px;" onclick="selectQuiz(2, 'luminous')">🌟 高光水澤極光感</button>
                </div>
            </div>

            <button class="btn-primary" style="width:100%;" onclick="submitSkinQuiz()">查看檢測推薦結果</button>
        </div>
    </div>

    <!-- 🌸 Modal: 品牌後台登入 -->
    <div class="modal-overlay" id="adminModal">
        <div class="modal-card" style="max-width:420px;">
            <button class="modal-close-btn" onclick="closeModal('adminModal')">✕</button>
            <h3 style="font-size:18px; color:var(--rosewood); margin-bottom:16px; text-align:center;">🔐 品牌專櫃後台管理</h3>
            <form onsubmit="handleAdminLogin(event)">
                <div style="margin-bottom:14px;">
                    <label style="font-size:12.5px; color:var(--text-muted); display:block; margin-bottom:4px;">管理帳號 Account</label>
                    <input type="text" id="adminAcc" required style="width:100%; padding:10px; border:1px solid var(--pink-accent); border-radius:8px; outline:none;" placeholder="admin">
                </div>
                <div style="margin-bottom:20px;">
                    <label style="font-size:12.5px; color:var(--text-muted); display:block; margin-bottom:4px;">管理密碼 Password</label>
                    <input type="password" id="adminPw" required style="width:100%; padding:10px; border:1px solid var(--pink-accent); border-radius:8px; outline:none;" placeholder="••••••••">
                </div>
                <button type="submit" class="btn-primary" style="width:100%;">登入後台 Console</button>
            </form>
        </div>
    </div>

    <!-- 🌸 Modal: 產品詳情 Quick View -->
    <div class="modal-overlay" id="productModal">
        <div class="modal-card" style="max-width:620px;">
            <button class="modal-close-btn" onclick="closeModal('productModal')">✕</button>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; align-items:center;" id="productModalContent">
                <!-- JS 動態填入產品資訊 -->
            </div>
        </div>
    </div>

    <!-- 🌸 JavaScript 互動邏輯 -->
    <script>
        // 1. 🌸 產品資料庫
        const productsData = [
            {
                id: 1,
                name: '櫻花光彩透亮前導精華',
                subtitle: 'Sakura Glow Illuminating Serum',
                category: 'skincare',
                price: 'NT$ 1,880',
                tag: 'NEW 🌸',
                img: 'upload/hero_jbeauty_v2.png',
                shades: ['#f8ecee', '#f5d6d9', '#e8b4b8'],
                desc: '富含高濃度櫻花葉植物萃取與三重玻尿酸，迅速穩定肌膚防禦力，打造極致瑩透水光好氣色。'
            },
            {
                id: 2,
                name: '無瑕微光零粉感粉底液',
                subtitle: 'Ultra-Feather Luminous Foundation',
                category: 'base',
                price: 'NT$ 2,150',
                tag: 'BEST SELLER 🔥',
                img: 'upload/header_jbeauty.png',
                shades: ['#fef5eb', '#fbe4d6', '#f2cfb9'],
                desc: '獨家輕羽羽化科技，一抹完美撫平毛孔紋理，實現全天候宛若天生的自然的微光裸肌。'
            },
            {
                id: 3,
                name: '日系水感潤澤唇膏 #02 嫩粉',
                subtitle: 'Pure Hydrating Lip Color #02 Sakura',
                category: 'lip',
                price: 'NT$ 1,200',
                tag: 'SPRING 🌸',
                img: 'upload/gallery_jbeauty1.png',
                shades: ['#e88494', '#d66b7a', '#b84d5d'],
                desc: '水感高保濕植萃油基底，呈現晶透水光玻璃唇感，為雙唇帶出宛如櫻花瓣般的自然好氣色。'
            },
            {
                id: 4,
                name: '光感微晶定妝蜜粉 (柔霧版)',
                subtitle: 'Soft Focus Micro Veil Powder',
                category: 'base',
                price: 'NT$ 1,650',
                tag: 'RECOMMEND ✨',
                img: 'upload/hero_jbeauty_v2.png',
                shades: ['#fff9fa', '#f8ecee'],
                desc: '極細微晶礦物球體，瞬效吸附多餘油脂，鎖住亮澤同時維持肌膚透亮呼吸感。'
            }
        ];

        // 相簿藝廊圖庫
        const galleryImages = [
            { img: 'upload/gallery_jbeauty_v2.png', caption: '櫻花潤澤雙唇系列 #02' },
            { img: 'upload/hero_jbeauty_v2.png', caption: '光彩前導精華 櫻花限量版' },
            { img: 'upload/header_jbeauty_v2.png', caption: '2026 日系無瑕底妝藝術展示' }
        ];
        let currentGalleryIdx = 0;

        // 2. 渲染產品清單
        function renderProducts(items) {
            const container = document.getElementById('productGridContainer');
            container.innerHTML = items.map(p => `
                <div class="product-card">
                    <div class="product-img-wrap">
                        <span class="product-badge-tag">${p.tag}</span>
                        <img src="${p.img}" class="product-img" alt="${p.name}">
                    </div>
                    <div class="product-body">
                        <div>
                            <div class="product-name">${p.name}</div>
                            <div class="product-subtitle">${p.subtitle}</div>
                            <div class="shade-picker">
                                ${p.shades.map((s, idx) => `<div class="shade-dot ${idx===0?'active':''}" style="background:${s}"></div>`).join('')}
                            </div>
                        </div>
                        <div class="product-footer">
                            <span class="product-price">${p.price}</span>
                            <button class="btn-quick-view" onclick="openProductModal(${p.id})">賞析 Quick View</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // 產品分類篩選
        function filterProducts(cat) {
            const btns = document.querySelectorAll('.nav-btn, .category-item');
            btns.forEach(b => b.classList.remove('active'));

            if (cat === 'all') {
                renderProducts(productsData);
            } else {
                const filtered = productsData.filter(p => p.category === cat);
                renderProducts(filtered);
            }
        }

        // 3. Before/After 滑桿控制
        function updateComparison(val) {
            document.getElementById('compOverlay').style.width = val + '%';
        }

        // 4. 相簿藝廊切換
        function prevGallery() {
            currentGalleryIdx = (currentGalleryIdx - 1 + galleryImages.length) % galleryImages.length;
            updateGalleryView();
        }
        function nextGallery() {
            currentGalleryIdx = (currentGalleryIdx + 1) % galleryImages.length;
            updateGalleryView();
        }
        function updateGalleryView() {
            const item = galleryImages[currentGalleryIdx];
            document.getElementById('galleryImg').src = item.img;
            document.getElementById('galleryCap').innerText = item.caption;
        }

        // 5. 英雄輪播 Slider
        let currentSlide = 1;
        setInterval(() => {
            document.querySelectorAll('.hero-slide').forEach(s => s.classList.remove('active'));
            currentSlide = (currentSlide % 3) + 1;
            document.getElementById('slide' + currentSlide).classList.add('active');
        }, 4000);

        // 6. Modal 彈出控制
        function openSkinQuizModal() {
            document.getElementById('skinQuizModal').classList.add('active');
        }
        function openAdminModal() {
            document.getElementById('adminModal').classList.add('active');
        }
        function openProductModal(id) {
            const p = productsData.find(x => x.id === id);
            if (!p) return;
            const content = document.getElementById('productModalContent');
            content.innerHTML = `
                <img src="${p.img}" style="width:100%; border-radius:12px; border:1px solid var(--pink-accent);" alt="${p.name}">
                <div>
                    <span style="font-size:11px; background:var(--sakura-light); color:var(--rosewood-light); padding:2px 8px; border-radius:10px;">${p.tag}</span>
                    <h3 style="font-size:18px; color:var(--rosewood); margin:8px 0 4px 0;">${p.name}</h3>
                    <p style="font-size:12px; color:var(--text-muted); margin-bottom:12px;">${p.subtitle}</p>
                    <p style="font-size:13px; color:var(--text-dark); line-height:1.7; margin-bottom:16px;">${p.desc}</p>
                    <div style="font-size:18px; font-weight:700; color:var(--rosewood-light); margin-bottom:16px;">${p.price}</div>
                    <button class="btn-primary" style="width:100%;" onclick="addToBookmark('${p.name}')">🌸 加入珍藏美妝清單</button>
                </div>
            `;
            document.getElementById('productModal').classList.add('active');
        }
        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        // 7. 肌膚檢測提交邏輯
        let quizAnswers = {};
        function selectQuiz(qNum, val) {
            quizAnswers[qNum] = val;
        }
        function submitSkinQuiz() {
            closeModal('skinQuizModal');
            alert("🌸 肌膚檢測完成！為您推薦【櫻花光彩透亮前導精華】與【無瑕微光零粉感粉底液】，已自動在作品頁中為您標示！");
            filterProducts('skincare');
        }

        // 8. 珍藏書籤邏輯
        let count = 3;
        function addToBookmark(name) {
            count++;
            document.getElementById('bookmarkCount').innerText = count;
            alert(`🌸 已將「${name}」成功加入您的日系美妝珍藏清單！`);
            closeModal('productModal');
        }
        function openBookmarkModal() {
            alert(`🌸 目前您共珍藏了 ${count} 項 Bloom Aesthetic 日系精緻美妝作品！`);
        }

        function handleAdminLogin(e) {
            e.preventDefault();
            alert("🔐 品牌後台驗證成功！歡迎登入 Bloom Aesthetic 管理後台。");
            closeModal('adminModal');
        }

        // 9. 🌸 櫻花飄落粒子畫布 (Sakura Blossom Canvas Animation)
        const canvas = document.getElementById('sakuraCanvas');
        const ctx = canvas.getContext('2d');
        let width = canvas.width = window.innerWidth;
        let height = canvas.height = window.innerHeight;

        window.addEventListener('resize', () => {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        });

        class Petal {
            constructor() {
                this.reset();
            }
            reset() {
                this.x = Math.random() * width;
                this.y = Math.random() * -height;
                this.size = Math.random() * 8 + 6;
                this.speedY = Math.random() * 1.2 + 0.8;
                this.speedX = Math.random() * 0.8 - 0.4;
                this.rotation = Math.random() * 360;
                this.rotSpeed = Math.random() * 1 - 0.5;
                this.opacity = Math.random() * 0.6 + 0.3;
            }
            update() {
                this.y += this.speedY;
                this.x += this.speedX + Math.sin(this.y * 0.01) * 0.5;
                this.rotation += this.rotSpeed;
                if (this.y > height + 20) this.reset();
            }
            draw() {
                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(this.rotation * Math.PI / 180);
                ctx.globalAlpha = this.opacity;
                ctx.fillStyle = '#f8b4c0';
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.bezierCurveTo(-this.size / 2, -this.size / 2, -this.size, this.size / 3, 0, this.size);
                ctx.bezierCurveTo(this.size, this.size / 3, this.size / 2, -this.size / 2, 0, 0);
                ctx.fill();
                ctx.restore();
            }
        }

        const petals = Array.from({ length: 28 }, () => new Petal());

        function animateSakura() {
            ctx.clearRect(0, 0, width, height);
            petals.forEach(p => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animateSakura);
        }

        // 初始化
        window.addEventListener('DOMContentLoaded', () => {
            renderProducts(productsData);
            animateSakura();
        });
    </script>
</body>
</html>