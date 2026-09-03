<?php
$do = $do ?? ($_GET['do'] ?? 'main');
$mains = [];
if (isset($Menu)) {
    $mains = $Menu->all(['sh'=>1, 'main_id'=>0]);
}
if (empty($mains)) {
    $mains = [
        ['id'=>1, 'text'=>'護膚儀式', 'href'=>'?do=main'],
        ['id'=>2, 'text'=>'彩妝美學', 'href'=>'?do=main'],
        ['id'=>3, 'text'=>'季節限定', 'href'=>'?do=news'],
        ['id'=>4, 'text'=>'品牌故事', 'href'=>'?do=main'],
        ['id'=>5, 'text'=>'美粧專欄', 'href'=>'?do=news']
    ];
}
$fallbackSubs = [
    1 => [['text'=>'光彩前導精華', 'href'=>'?do=main'], ['text'=>'櫻花水感保濕乳', 'href'=>'?do=main'], ['text'=>'敏弱肌修護指南', 'href'=>'?do=news']],
    2 => [['text'=>'無瑕光透底妝', 'href'=>'?do=main'], ['text'=>'日系柔霧唇膏', 'href'=>'?do=main'], ['text'=>'春季妝容趨勢', 'href'=>'?do=news']],
    3 => [['text'=>'春季限定系列', 'href'=>'?do=news'], ['text'=>'新品上市情報', 'href'=>'?do=news']],
    4 => [['text'=>'品牌理念', 'href'=>'?do=main'], ['text'=>'美學誌專欄', 'href'=>'?do=news']],
    5 => [['text'=>'最新美妝情報', 'href'=>'?do=news'], ['text'=>'保養知識庫', 'href'=>'?do=news']]
];
?>
<header class="front-navbar">
    <div class="front-navbar-inner">
        <a class="front-brand" href="index.php">🌸 Bloom Aesthetic</a>
        <nav class="front-nav" aria-label="主選單">
            <?php foreach ($mains as $main):
                $subs = [];
                if (isset($Menu) && isset($main['id'])) {
                    $subs = $Menu->all(['main_id'=>$main['id']]);
                }
                if (empty($subs) && isset($fallbackSubs[$main['id']])) {
                    $subs = $fallbackSubs[$main['id']];
                }
            ?>
                <div class="front-nav-item">
                    <a href="<?= htmlspecialchars($main['href']); ?>"><?= htmlspecialchars($main['text']); ?></a>
                    <?php if (!empty($subs)): ?>
                        <div class="front-submenu">
                            <?php foreach ($subs as $sub): ?>
                                <a href="<?= htmlspecialchars($sub['href']); ?>"><?= htmlspecialchars($sub['text']); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </nav>
        <button class="front-admin-button" type="button" onclick="lo('?do=login')">🔑 品牌後台管理</button>
    </div>
</header>
