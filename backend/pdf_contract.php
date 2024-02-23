<?php

require_once('tcpdf/tcpdf.php');
session_start();
require("function/function.php");

$currentProject = getCurrentProject($_GET["id"]);
$allProjectEmployee = getAllProjectEmployee($_GET["id"]);
$allProjectPeriod = getAllProjectPeriod($_GET["id"]);
$currentDistrict = getCurrentDistrict($currentProject["land_tumbol"]);
$currentAmphure = getCurrentAmphure($currentProject["land_amphur"]);
$currentProvince = getCurrentProvince($currentProject["land_province"]);

$yThai = date("Y")+543;
$dateNow = date("d/m/").$yThai;

// create new PDF document
$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Website for Building Contractor Management System');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set font

//$fontname = $pdf->addTTFfont('fonts/Browa.ttf', 'TrueTypeUnicode', '', 32);
$pdf->SetFont('thsarabunpsk', '', 16, '', true);


$line_html="";
//PAGE 3 >> PAGE 1
$pdf->AddPage();
$pdf->setPageOrientation ('P', $autopagebreak='', $bottommargin='');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(true, 25);
// Set some content to print

$total = 0;
$a=0;
foreach($allProjectPeriod as $data){
$converrPeriodPrice = convertMoneyToText($data['period_price']);

$line_html  .= <<<EOD
                <tr>
                    <td style="width: 10%;text-align:center;">งวดที่ {$data['period_number']}</td>
                    <td style="width: 90%;text-align:left;">ชำระร้อยละ {$data['period_price']} ({$converrPeriodPrice}) เมื่อผู้รับจ้างได้ดำเนินการ {$data['period_detail']} แล้วเสร็จ</td>
                </tr>
EOD;
}
//$cTotal = number_format($total);
$cTotal = number_format($currentProject["total_price"]);
$convertPrice = convertMoneyToText($cTotal);


$header_html  .= <<<EOD
<div style="text-align:center;margin:0;"><b style="font-size:25px;">หนังสือสัญญาจ้างเหมาก่อสร้าง</div>
<div style="text-align:right;margin:0;">
สัญญาเลขที่ {$currentProject["run_number"]}<br/>วันที่ {$dateNow}
</div>
                
EOD;

$body_html  .= <<<EOD
<div style="text-align:left;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; หนังสือสัญญาฉบับนี้ทำขึ้นระหว่าง นาย/นาง/นางสาว {$currentProject["firstname"]} {$currentProject["lastname"]} ที่อยู่ {$currentProject["address"]} ซึ่งต่อไปในหนังสือสัญญาฉบับนี้จะเรียกว่า “<b>ผู้ว่าจ้าง</b>” ฝ่ายหนึ่ง กับบริษัท {$currentProject["company_name"]} จำกัด ทะเบียนนิติบุคคล เลขที่ {$currentProject["juristic_person"]} โดย {$currentProject["building_authority"]} กรรมการผู้มีอำนาจ  ทำการแทนสำนักงาน {$currentProject["company_address"]} ซึ่งต่อไปในสัญญานี้จะเรียกว่า “<b>ผู้รับจ้าง</b>” อีกฝ่ายหนึ่ง
</div>
<div style="text-align:left;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; โดยที่ผู้ว่าจ้างมีความประสงค์จะว่าจ้างผู้มีความรู้ความสามารถ ความชำนาญและประสบการณ์ในด้านการก่อสร้างบ้านพักอาศัย ให้กับผู้ว่าจ้าง โดยที่ผู้รับจ้างเป็นผู้มีความสามารถ ความชำนาญและประสบการณ์ ในด้านดังกล่าว และประสงค์จะรับจ้างดำเนินการดังกล่าว ดังนั้น ทั้งสองฝ่ายจึงได้ตกลงทำสัญญาจ้างเหมาก่อสร้างกัน โดยมีข้อความดังต่อไปนี้
</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>หมวดที่ 1 วัตถุประสงค์ของสัญญา</b></div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ว่าจ้างตกลงจ้างและผู้รับจ้างตกลงรับจ้างทำการก่อสร้างบ้านพักอาศัยแบบ {$currentProject["building_type"]} ซึ่งตั้งอยู่บนที่ดินของผู้ว่าจ้าง หรือ ที่ดินที่ผู้ว่าจ้างได้รับความยินยอมจากเจ้าของให้ทำการก่อสร้าง ซึ่งที่ดินดังกล่าวเป็น ที่ดินโฉนดเลขที่ {$currentProject["land_deed"]} ระวาง {$currentProject["land_part"]} เลขที่ดิน {$currentProject["land_number"]} หน้าสำรวจ {$currentProject["land_check"]} ตำบล/แขวง {$currentDistrict["d_name_th"]} อำเภอ/เขต {$currentAmphure["a_name_th"]} จังหวัด {$currentProvince["p_name_th"]} และมีเนื้อที่ประมาณ {$currentProject["area_amount"]} ไร่ {$currentProject["area_work"]} งาน {$currentProject["area_squre"]} ตารางวา โดยมีเอกสารแนบท้าย คือ รายละเอียดอาคาร, เอกสารเสนอราคา, รายการวัสดุก่อสร้าง และบัญชีแสดงปริมาณวัสดุและราคา ที่ใช้ในการก่อสร้าง ถือเป็นส่วนหนึ่งขอสัญญานี้ ซึ่งต่อไปจะเรียกว่า“<b>งานที่จ้าง</b>”
</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>หมวดที่ 2 ระยะเวลาของสัญญา การเริ่มทำงาน และกำหนดแล้วเสร็จของงาน</b></div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.1 ผู้รับจ้างจะต้องเป็นผู้ออกแบบและจัดทำรายละเอียดของแบบ, รายการก่อสร้างพร้อมยื่นขออนุญาตก่อสร้าง
ต่อหน่วยงานที่เกี่ยวข้องภายในกำหนดเวลา {$currentProject["amount_date"]} วัน นับจากวันลงนามทำสัญญา ในกรณีที่ผู้ว่าจ้างปรับเปลี่ยน รายละเอียดแบบเพิ่มเติมนอกเหนือสัญญา และมีผลทำให้การจัดทำแบบล่าช้าออกไป ผู้ว่าจ้างยินยอมให้ ผู้รับจ้างขยาย ระยะเวลาการทำงานออกไป โดยทางผู้รับจ้างจะทำเอกสารเป็นลายลักษณ์ อักษรให้กับผู้ว่าจ้างลงนามรับทราบ
</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.2 ทั้งสองฝ่ายตกลงให้สัญญานี้มีกำหนดระยะเวลา {$currentProject["amount_date"]} วัน โดยเริ่มนับตั้งแต่วันที่ได้รับอนุญาตก่อสร้างอาคารจากเจ้าพนักงานตามกฎหมาย 
</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.3 หากผู้รับจ้างทำงานไม่แล้วเสร็จตามสัญญา ผู้รับจ้างตกลงให้ผู้ว่าจ้างคิดค่าปรับในอัตราร้อยละศูนย์จุดศูนย์
หนึ่งของราคาการรับจ้าง ก่อสร้างอาคาร โดปรับเป็นรายวัน นับแต่วันที่ล่วงเลยกำหนดระยะเวลาตามสัญญา
</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.4 ในกรณีที่ผู้รับจ้างไม่สามารถลงมือทำงานตามข้อ 2.2 ได้เนื่องจากเกิดเหตุใด ๆ ที่มิอาจหลีกเลี่ยงได้และเป็น
เหตุให้การก่อสร้าง ต้องหยุดชะงักลง โดยมิใช่ความผิดของผู้รับจ้าง หรือมีพฤติการณ์ที่ผู้รับจ้างไม่ต้องรับผิดชอบ ให้ผู้ว่าจ้างขยายระยะเวลาแล้วเสร็จตามสัญญาออกไป เท่ากับเวลาที่เสียไปเพราะเหตุดังกล่าว หากเหตุใด ๆ ตามวรรคแรกเกิด
จากการกระทำของผู้ว่าจ้าง เป็นเหตุให้ผู้รับจ้างต้องหยุดงานเกินกว่า 30 วัน หรือ การก่อสร้างตามสัญญามิอาจกระทำต่อไปได้ อันเนื่องมาจากเหตุสุดวิสัย เช่น ที่ดินถูกเวนคืน ความเสียหายเกิดจากวาตภัย, อัคคีภัย, อุทกภัย, แผ่นดินไหว 
หรือ การให้ข้อมูล การชี้หลักเขต สภาพและที่ตั้งของที่ดินผิดพลาด ฯลฯ ผู้รับจ้างจะใช้สิทธิบอกเลิกสัญญาก็ได้ และผู้ว่าจ้างยินยอมชำระค่าก่อสร้าง ให้แก่ผู้รับจ้าง ตามมูลค่าของงวดงานในสัญญาที่ได้ก่อสร้างไปแล้ว
</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.5 หากผู้รับจ้างประสบอุปสรรคในการก่อสร้างซึ่งผู้ว่าจ้างมิได้คาดคิดมาก่อน เช่น สิ่งกีดขวางที่อยู่ใต้ดิน การ
ปิดถนนเข้าสู่บริเวณก่อสร้าง ฯลฯ และอุปสรรคดังกล่าวทำให้ผู้รับจ้างต้องเสียค่าใช้จ่ายเพิ่มขึ้น ผู้ว่าจ้างยินยอมชดใช้ ค่าใช้จ่ายที่เพิ่มขึ้นแก่ผู้รับจ้างตามความเป็นจริง
</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>หมวดที่ 3 ค่าจ้างเหมาตามสัญญา</b></div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3.1 การจ้างตามสัญญานี้ ผู้ว่าจ้างและผู้รับจ้างตกลงจ้างเหมา รวมทั้งวัสดุสิ่งของสัมภาระ ค่าแรงงานรวมเป็น
เงินทั้งสิ้น {$cTotal} บาท ( {$convertPrice} )</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3.2 ผู้ว่าจ้างตกลงจ่ายและผู้รับจ้างตกลงรับเงินค่าจ้าง โดยกำหนดการจ่ายเงินเป็นงวด ๆ ดังนี้</div>
<br/>
<table>
{$line_html}
</table>
<br/>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; การชำระเงินดังกล่าวข้างต้น ผู้ว่าจ้างจะต้องนำเงินไปชำระยังสถานที่ทำงานในเวลาทำการปกติของ ผู้รับจ้าง หรือ สถานที่ที่ผู้ว่าจ้างแจ้ง ให้ทางผู้รับจ้างไปรับ หากผู้ว่าจ้างชำระเงินเป็นเช็ค จะมีผลสมบูรณ์ก็ต่อเมื่อเช็คนั้น ๆ เรียกเก็บเงินเรียบร้อยแล้ว</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>หมวดที่4 หน้าที่และความรับผิดของผู้ว่าจ้าง</b></div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4.1 ผู้ว่าจ้างมีสิทธิ์ที่จะทำการแก้ไขเพิ่มเติม หรือ ลดงานจากรูปแบบและรายการก่อสร้างเดิม หรือเปลี่ยนแปลง วัสดุ อุปกรณ์ต่าง ๆ ได้ทุกอย่างภายในเวลาที่กำหนดร่วมกัน โดยไม่ต้องบอกเลิกสัญญานี้ การเพิ่มหรือลดงานจะต้องคิดราคา กำหนดเวลา กำหนดชำระเงิน ผู้ว่าจ้างและผู้รับจ้างจะต้องตกลงกันเป็นลายลักษณ์อักษร ทั้งนี้การแก้ไขเพิ่มเติมหรือ ลดงานจากรูปแบบและรายการก่อสร้างเดิม หรือเปลี่ยนแปลงวัสดุอุปกรณ์ต่าง ๆ หากได้กระทำลงจนเป็นเหตุให้ความ แข็งแรงของโครงสร้างอาคารลดลงกว่า มาตรฐาน ผู้รับจ้างมีสทิธิ์ที่จะไมยอมรับการแก้ไขเปลี่ยนแปลงดังกล่าวได้</div>
<div style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; สัญญาฉบับนี้ทำขึ้นเป็นสองฉบับ มีข้อความถูกต้องตรงกัน และคู่สัญญาได้ตรวจอ่านเรียบรัอยแล้ว รับว่าตรงตามเจตนาทุกประการ จึงได้ลงลายมือชื่อไว้ต่อหน้าพยาน และต่างฝ่ายต่างยึดถือสัญญานี้ไว้ฝ่ายละ 1 ฉบับ</div>
EOD;



$footer_html1  .= <<<EOD
    <table>
                <tr>
                    <td>
                        <div align="center">
                            <table>
                            
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                <br/>
                                ลงชื่อ.........................................................ผู้ว่าจ้าง<br/>
                                <br/>
                                (.........................................................)
                                </td>
                            </tr>
                            
                           </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center">
                            <table>
                            
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                <br/>
                                ลงชื่อ.........................................................ผู้รับจ้าง<br/>
                                <br/>
                                (.........................................................)
                                </td>
                            </tr>
                            
                           </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center">
                            <table>
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                <br/>
                                ลงชื่อ.........................................................พยาน<br/>
                                <br/>
                                (.........................................................)
                                </td>
                            </tr>
                            
                           </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center">
                            <table>
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                <br/>
                                ลงชื่อ.........................................................พยาน<br/>
                                <br/>
                                (.........................................................)
                                </td>
                            </tr>
                            
                           </table>
                        </div>
                    </td>
                </tr>
                

            </table>

EOD;
$html = <<<EOD
{$header_html}
{$body_html}
{$footer_html1}
EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('รายงาน.pdf', 'I');
?>

<?php die(); ?>
