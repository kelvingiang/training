<?php
$objHtml = new MyHtml();
$txttitle = $objHtml->textbox('title', @$vTitle,array('class'=> 'regular-text'));
    $arr                       = array( 'id' => 'year');
    $options['data']       = array(
                                  '2016' => '2016',
                                  '2017' => '2017',
                                  '2018' => '2018',
                                  '2019' => '2019',
                                  '2020' => '2020',
                                  '2021' => '2021',
                                  '2022' => '2022',
                                  '2025' => '2023',
                                  '2024' => '2024',
                                  '2025' =>'2025'  );
$selectYear = $objHtml->selectbox('year', @$vTitle,$arr,$options);
    $arr                       = array( 'id' => 'month');
    $options['data']       = array(
                                  '01' => '01',
                                  '02' => '02',
                                  '03' => '03',
                                  '04' => '04',
                                  '05' => '05',
                                  '06' => '06',
                                  '07' => '07',
                                  '08' => '08',
                                  '09' => '09',
                                  '10' =>' 10',
                                  '11' => '11',
                                  '12' => '12'  );
    //---------------------------------------------------------------------------------------------
    // CAP GIA TRI SELECT OPTION THONG QUA HAM FOR
 // Cmt 
 //---------------------------------------------------------------------------------------------
$selectMonth = $objHtml->selectbox('month', @$vTitle,$arr,$options);

    $arr                       = array( 'id' => 'day');
    $aa = array();
    for( $i = 1;$i < 31; $i++)
    {
       //array_push($aa, $i);
        $aa[$i] = $i;
    }
    $options2['data'] = $aa;

$selectDay = $objHtml->selectbox('day', @$vTitle,$arr,$options2);
?>
<div class=" wrap">
    <h2><?php echo $lbl ?></h2>
    <form action="" method="post" enctype="multipart/form-data" id="123" name="123" >
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label><?php echo translate('活動項目') . ':'; ?></label>
                    </th>
                    <td>
                        <?php echo $txttitle; ?>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th scope="row">
                        <label><?php echo translate('日期') . ':'; ?></label>
                    </th>
                    <td>
                        <label>年</label>   <?php echo $selectYear; ?>
                        <label>月</label>   <?php echo $selectMonth; ?>
                        <label>日</label>   <?php echo $selectDay; ?>
                    </td>
                </tr>
            </tbody>
        </table>
              <p class="submit">
			<input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit">
            </p>
    </form>

</div>