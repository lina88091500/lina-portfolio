<div class="di back-center-panel">
    <!--後台頂部導覽區-->
    <table width="100%" style="margin-bottom:10px;">
        <tbody>
            <tr>
                <td style="width:72%; font-weight:600; text-align:center; padding:6px; background:var(--j-sakura); border-radius:10px; border:1px solid var(--j-pink-accent);">
                    <a href="?do=admin" style="color:var(--j-primary-dark); text-decoration:none; font-size:14px;">🌸 品牌網頁與視覺管理中心 (Admin Control Panel)</a>
                </td>
                <td style="text-align:right;">
                    <button onclick="document.cookie='user=';location.replace('index.php')" style="padding:8px 16px; font-size:12.5px;">🔐 管理員登出 Log out</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="width:100%; height:460px; margin:auto; overflow:auto; border:1px solid var(--j-pink-accent); border-radius:14px; padding:12px; background:#FFFDF9; box-sizing:border-box;">
        <p class="t cent botli" style="font-size:15px;">🌸 日系美學賞析藝廊圖檔管理 (Gallery Images)</p>
        <form method="post" action="./api/edit.php?table=<?= $do ?>">
            <table width="100%" style="table-layout:fixed; word-wrap:break-word;">
                <tbody>
                    <tr class="yel">
                        <td width="55%">美學藝廊圖片 (Gallery Photo)</td>
                        <td width="15%">顯示</td>
                        <td width="15%">刪除</td>
                        <td width="15%">操作</td>
                    </tr>
                    <?php 
                    $db=${ucfirst($do)};
                    
                    $all=$db->count();
                    $div=3;
                    $pages=ceil($all/$div);
                    $now=$_GET['p']??1;
                    $start=($now-1)*$div;
                    $rows=$db->all(" limit $start,$div");

                    if(empty($rows)){
                        $rows = [
                            ['id'=>1, 'img'=>'gallery_jbeauty_v2.png', 'sh'=>1],
                            ['id'=>2, 'img'=>'hero_jbeauty_v2.png', 'sh'=>1]
                        ];
                    }
                    foreach($rows as $row):
                    ?>
                    <tr>
                        <td width="55%" class="cent">
                            <img src="./upload/<?= $row['img']; ?>" style="width:160px; height:90px; object-fit:cover; border-radius:8px; border:1px solid var(--j-pink-accent);">
                        </td>
                        <td width="15%" class="cent">
                            <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh']==1)?'checked':''; ?>>
                        </td>
                        <td width="15%" class="cent">
                            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
                        </td>
                        <td width="15%" class="cent">
                            <input type="button" value="更新圖片" onclick="op('#cover','#cvr','include/update_<?= $do; ?>.php?id=<?= $row['id'];?>')" style="padding:4px 8px; font-size:11.5px;">
                        </td>
                        <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!--分頁條-->
            <div class="cent" style="margin-top:14px;">
                <?php
                if($pages > 1) {
                    if($now-1 > 0){
                        $prev=$now-1;
                        echo "<a class='bl' href='?do=$do&p=$prev' style='margin:0 4px;'> ‹ </a>";
                    }

                    for($i=1;$i<=$pages;$i++){
                        $size=($i==$now)?'16px':'13px';
                        echo "<a href='?do=$do&p=$i' style='font-size:$size; margin:0 4px; color:var(--j-primary);'> $i </a>";
                    }

                    if($now+1 <= $pages){
                        $next=$now+1;
                        echo "<a class='bl' href='?do=$do&p=$next' style='margin:0 4px;'> › </a>";
                    }
                }
                ?>
            </div>

            <table style="margin-top:14px; width:100%;">
                <tbody>
                    <tr>
                        <td width="40%">
                            <input type="button" onclick="op('#cover','#cvr','include/<?= $do; ?>.php')" value="➕ 新增賞析圖片" style="padding:6px 14px;">
                        </td>
                        <td class="cent" width="60%">
                            <input type="submit" value="修改確定 Save" style="padding:6px 20px;">
                            <input type="reset" value="重置 Reset" style="background:#FFFDF9; border-color:#8C7075; color:#8C7075; padding:6px 16px;">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>