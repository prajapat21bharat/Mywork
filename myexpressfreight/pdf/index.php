<?php
//============================================================+
// File name   : example_021.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 021 for TCPDF class
//               WriteHTML text flow
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML text flow.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');

// set default header data
$pdf->SetHeaderData('logo.jpg', '50', '', '');
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, '20', PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();

// create some HTML content
//$html = '<h1>Example of HTML text flow</h1>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. <em>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</em> <em>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</em><br /><br /><b>A</b> + <b>B</b> = <b>C</b> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>B</i> = <i>A</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>A</i> = <i>B</i> -&gt; &nbsp;&nbsp; <b>A</b> + <b>B</b> = <b>C</b> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>B</i> = <i>A</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>A</i> = <i>B</i> -&gt; &nbsp;&nbsp; <b>A</b> + <b>B</b> = <b>C</b> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>B</i> = <i>A</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>A</i> = <i>B</i> -&gt; &nbsp;&nbsp; <b>A</b> + <b>B</b> = <b>C</b> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>B</i> = <i>A</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>A</i> = <i>B</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <b>A</b> + <b>B</b> = <b>C</b> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>B</i> = <i>A</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>A</i> = <i>B</i> -&gt; &nbsp;&nbsp; <b>A</b> + <b>B</b> = <b>C</b> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>B</i> = <i>A</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>A</i> = <i>B</i> -&gt; &nbsp;&nbsp; <b>A</b> + <b>B</b> = <b>C</b> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>B</i> = <i>A</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>A</i> = <i>B</i> -&gt; &nbsp;&nbsp; <b>A</b> + <b>B</b> = <b>C</b> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>B</i> = <i>A</i> &nbsp;&nbsp; -&gt; &nbsp;&nbsp; <i>C</i> - <i>A</i> = <i>B</i><br /><br /><b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u> <b>Bold</b><i>Italic</i><u>Underlined</u>';


if(isset($_POST['mutual_agreement_submit']))
{
	$_SERVER['REQUEST_URI'];
	
	
define('UPLOAD_DIR','signatures/');
$file = $_POST['agent_signa']; // data in base64 'data:image/png....';
$img = str_replace('data:image/png;base64,', '', $file);
$img_name = 'myexpressfreight_'.date('YmdHis');		//name of image
//echo base64_decode($img);exit;
file_put_contents(UPLOAD_DIR.$img_name.'.jpg', base64_decode($img));	//saving file in directory
//$test_mimg=$pdf->Image(UPLOAD_DIR.$img_name.'.jpg', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
$test_=UPLOAD_DIR.$img_name.'.jpg';
//$image_path=$_SERVER['SERVER_NAME'].str_replace('index.php','',$_SERVER['REQUEST_URI']).$test_;
$image_path=str_replace('index.php','',$_SERVER['REQUEST_URI']).$test_;
//echo $_SERVER['SERVER_NAME']; exit;
	
$toolcopy = '<img src="'.$image_path.'"  width="100" height="100">';
	
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

//$sign1=$pdf->Image($test_, '', '', '10', '10', 'JPG', '', '', false, 150, '', false, false, 1, false, false, false);




// The '@' character is used to indicate that follows an image data stream and not an image file name


//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

// test Cell stretching
$pdf->Cell(0, 0, '', '', 1, 'C', 0, '', 0);
$heading='<h3>Mutual Non-Disclosure Agreement</h3>';
// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
$pdf->writeHTML($heading, true, 0, true, 0,'C');
$pdf->Cell(0, 0, '', '', 1, 'C', 0, '', 0);
$pdf->Cell(0, 0, '', '', 1, 'C', 0, '', 0);

	$html='</br></br></br><table><tr><td colspan="2"><p class="para">This Mutual Non-Disclosure Agreement ("Agreement") is made and entered into as of <strong>'.$_POST["date_agg_effective"].'</strong> (the "Effective Date"), by and between G. Katen & Partners ("GKP"), and the party named on the signature page below ("Participant")."</p>
					<p class="para">This Agreement is intended to facilitate the exchange of proprietary information in furtherance of discussions between the parties related to the purpose described below (the “Purpose”). The parties desire to disclose and examine such proprietary information solely in furtherance of the Purpose. The party receiving Confidential Information shall be hereinafter referred to as the “Receiving Party,” and the party disclosing such Confidential Information shall be hereinafter referred to as the “Disclosing Party.”</p>
					<p class="para">In consideration of the covenants and conditions set forth below, the parties agree as follows:</p>
					<strong>
						<h3>1.Confidential Information. </h3>
					</strong>
					<p class="para">As used in this Agreement, "Confidential Information” means any information, including without limitation, business information, technical, and marketing information, provided such information is identified as confidential at the time of disclosure or is disclosed in a manner that it may be reasonably inferred to be confidential and/or proprietary to the Disclosing Party. In the event of an inadvertent disclosure of any information, such information shall be immediately returned to the Disclosing Party at their request.</p>
					<p class="para">Confidential Information does not include information that:</p>
					<ul type="I">
						<li>becomes generally available to the public through no fault of the Receiving Party;</li>
						<li>is, prior to its initial disclosure hereunder, in the possession of the Receiving Party;</li>
						<li>is acquired by the Receiving Party from any third party without any restrictions on its use or disclosure; or</li>
						<li>is independently developed by the Receiving Party without use of the Confidential Information.</li>
					</ul>
					<strong>
						<h3>2. Non-Disclosure and Use Restrictions.</h3>
					</strong>
					<p class="para">Any Confidential Information disclosed pursuant to this Agreement shall be retained in confidence by the Receiving Party and used only for the Purpose. Confidential Information may be disclosed only to employees or consultants of the Receiving Party who have a need to know. Any consultant of Receiving Party who receives Confidential Information under this Agreement shall be similarly bound in writing to the terms of this Agreement. The Receiving Party shall be responsible for any breach of this Agreement by an employee or consultant of such Receiving Party. The Receiving Party shall use the same degree of care as it uses to protect its own confidential information of a similar nature, but no less than reasonable care, to prevent the unauthorized use, dissemination or publication of the Confidential Information.</p>
					<strong>
						<h3>3. Term and Duration.</h3>
					</strong>
					<p class="para">This Agreement will terminate two (2) years from the Effective Date.  All obligations hereunder shall continue for five (5) years from the date of disclosure.</p>
					<strong>
						<h3>4. Legal Process.</h3>
					</strong>
					<p class="para">If the Receiving Party becomes subject to a demand for discovery or disclosure of the Confidential Information of the other party under legal process, such Receiving Party shall give to the other prompt notice of the demand prior to furnishing the Confidential Information demanded, and, at the expense of the Disclosing Party, shall obtain or cooperate with the Disclosing Party in seeking reasonable arrangements to protect the confidential and proprietary nature of the Confidential Information.</p>
					<strong>
						<h3>5. Ownership of Confidential Information.</h3>
					</strong>
					<p class="para">All Confidential Information disclosed under this Agreement shall remain the exclusive property of the Disclosing Party and nothing contained herein shall be construed as a grant, express or implied or by estoppel, of a transfer, assignment, license, lease of any right, title or interest in the Confidential Information.</p>
					<strong>
						<h3>6. No Warranty.</h3>
					</strong>
					<p class="para">No warranty or representation is made by either party hereto that any information transmitted by it hereunder is true and correct, patentable or copyrightable, or that any such information involves concepts or embodiments that are free of infringement of other rights.</p>
					<strong>
						<h3>7. Return of Confidential Information.</h3>
					</strong>
					<p class="para">Upon the completion or termination of any discussions or business relationship between the parties, or at any time within fourteen (14) days of receipt of a written request of the Disclosing Party, the Receiving Party shall (i) promptly return to the Disclosing Party all Confidential Information disclosed in tangible form and copies thereof; or (ii) promptly destroy such Confidential Information (including all copies thereof) and certify their destruction to the Disclosing Party.</p>
					<strong>
						<h3>8. Equitable Relief.</h3>
					</strong>
					<p class="para">The parties acknowledge and agree that the covenants set forth in this Agreement are reasonable and necessary for the protection of the parties’ business interests and that irreparable injury may result if they are breached and that in the event of any actual or potential breach of any such covenant that the non-breaching party shall be entitled to seek immediate temporary injunctive relief. Nothing herein shall be construed as prohibiting any party from pursuing any other remedies available to it for such breach or threatened breach, including the recovery of damages that it is able to prove.</p>
					<strong>
						<h3>9. No Other Business Relationship.</h3>
					</strong>
					<p class="para">This Agreement does not represent or imply any agreement or commitment to enter into any further business relationship. This Agreement does not create any agency or partnership relationship between the parties or authorize a party to use the other party’s name or trademarks. Neither party is precluded from independently pursuing any activities similar to or in competition with the Purpose contemplated herein. Neither party will be liable to the other for any of the costs associated with the other’s efforts in connection with this Agreement.</p>
					<strong>
						<h3>10. Export Control.</h3>
					</strong>
					<p class="para">The parties recognize that communication or transfer of any information received pursuant to the Purpose may be subject to specific government export approval. Each party agrees to comply with all applicable export control legislation with respect to Confidential Information received hereunder.</p>
					<strong>
						<h3>11. Governing Law.</h3>
					</strong>
					<p class="para">This Agreement shall be governed and construed in accordance with the internal laws of the State of New Jersey, without giving effect to the choice of law or conflicts of law principles of such state. Any legal action or proceeding relating to this Agreement shall be instituted in a state or federal court in Bergen County, New Jersey.</p>
					<strong>
						<h3>12. Successors and Assigns.</h3>
					</strong>
					<p class="para">This Agreement will be binding upon the successors and/or assigns of the parties.</p>
					<strong>
						<h3>13. Counterparts.</h3>
					</strong>
					<p class="para">This Agreement may be signed in two or more counterparts, each of which shall be deemed an original, but all of which together shall constitute one and the same instrument.</p>
					<strong>
						<h3>14. Severability.</h3>
					</strong>
					<p class="para">If any provision of this Agreement shall be adjudged by any court of competent jurisdiction to be unenforceable or invalid, that provision shall be limited or eliminated to the minimum extent necessary so that this Agreement shall otherwise remain in full force and effect and enforceable.</p>
					<strong>
						<h3>15. Waiver.</h3>
					</strong>
					<p class="para">The failure of either party to act in the event of a breach of this Agreement by the other shall not be deemed a waiver of such breach or a waiver of future breaches, unless such waiver shall be in writing and signed by the party against whom enforcement is sought.</p>
					<strong>
						<h3>16. Entire Agreement/No Amendment.</h3>
					</strong>
					<p class="para">This Agreement constitutes the entire agreement and understanding of the Parties with respect to the subject matter of this Agreement. Any amendment or modification of this Agreement shall be in writing and executed by a duly authorized representative of the parties.</p>
					<strong>
						<h3>17. Authorized Signature.</h3>
					</strong>
					<p class="para">This Agreement is valid only when signed by an employee with authority to bind that party.</p><br></td></tr>
					<tr height="15px"><td><strong>Purpose: Approval Date : '.$_POST["date_agg_approval"].'</strong></td><br></tr>
					<tr><td><p>	G. Katen & Partners<br>
								9903 Santa Monica Blvd, Suite 356<br>
								Beverly Hills, California 90212<br>
								Tel: 424-354-3241</p></td><td></td></tr><br>
					<tr><td>Authorized Agent : </td><td>Company : </td></tr>
					<tr><td><strong>'.$_POST["authorized_agent"].'</strong></td><td><strong>'.$_POST["client_company_name"].'</strong></td></tr><br>
					<tr><td>Signature</td><td>Name : </td></tr>
					<tr><td><strong>'.$toolcopy.'</strong></td><td><strong>'.$_POST["client_name"].'</strong></td></tr>
					
					<tr><td></td><td>Signature : </td></tr>
					<tr><td><strong></strong></td><td><strong>'.$_POST["client_sign"].'</strong></td></tr><br>
					
					<tr><td></td><td>Email : </td></tr>
					<tr><td><strong></strong></td><td><strong>'.$_POST["client_email"].'</strong></td></tr><br>
					
					<tr><td></td><td>Address : </td></tr>
					<tr><td><strong></strong></td><td><strong>'.$_POST["client_address"].'</strong></td></tr><br>
					
					<tr><td></td><td>Tel : </td></tr>
					<tr><td><strong></strong></td><td><strong>'.$_POST["client_phone"].'</strong></td></tr><br>
					
					<tr><td></td><td>Fax: </td></tr>
					<tr><td><strong></strong></td><td><strong>'.@$_POST["client_fax"].'</strong></td></tr><br>
					
					</table>';
	}
	
	if(isset($_POST['sales_agency_submit']))
	{
		// test Cell stretching
			$pdf->Cell(0, 0, '', '', 1, 'C', 0, '', 0);
			$heading='<h3>SALES AGENCY AGREEMENT</h3>';
			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			$pdf->writeHTML($heading, true, 0, true, 0,'C');
			$pdf->Cell(0, 0, '', '', 1, 'C', 0, '', 0);
			$pdf->Cell(0, 0, '', '', 1, 'C', 0, '', 0);
		
		$agg_effective_day=$_POST['agg_effective_day'];
		$agg_agent_name=$_POST['agg_agent_name'];
		$agg_agent_agency=$_POST['agg_agent_agency'];
		$agg_agent_address=$_POST['agg_agent_address'];
		$agg_representative=$_POST['agg_representative'];
		
		$agg_sign1='Signature1';
		$agg_sign2='Signature2';
		
		$agg_name_title_1=$_POST['agg_name_title_1'];
		$agg_name_title_2=$_POST['agg_name_title_2'];
		$html='<p class="para">This Sales Agency Agreement (“Agreement”) is made and effective as of <strong>'.ucfirst($agg_effective_day).'</strong>, 2014 between G. Katen & Partners (the “Principal”), a New Jersey limited liability company with its principal offices located in Beverly Hills, California , and  <strong>'.ucfirst($agg_agent_name).'</strong> (the "Agent"), a  <strong>'.ucfirst($agg_agent_agency).'</strong>  independent sales representative with principal mailing address <strong>'.ucfirst($agg_agent_address).'</strong>.</p>
					<p class="para">In consideration of the mutual agreements and covenants contained herein, the parties hereby agree as follows:
						<ol type="1">
							<h3><li>RECITALS</h3></li>
								<ul type="a">
									<li>Principal desires appoint Agent as a general sales agent for all sales of Principal’s products and services.</li>
									<li>Agent desires to accept such appointment and to perform all the provisions of this agreement.</li>
								</ul>
							
							<h3><li>DURATION</li></h3>
							<p class="para">This Agreement shall be in force for two year effective from the date of this agreement.  The Agreement will automatically renew at the end of each two-year term unless written notice of termination or modification is provided.</p>
							<h3><li>AGENT’S BEST EFFORTS</li></h3>
							<p class="para">Under this Agreement, Agent will devote its best efforts to register potential clients with Principal and/or provide Principal with the contact information of potential clients resulting from such efforts.</p>
							
							<h3><li>COMMISSIONS</li></h3>
								<ul type="a">
									<li>Agent, during the term of the Agreement, shall receive a commission on the sale or rental of Principal’s products to a New Client.</li>
									<li>Under this Agreement, a New Client is a client who
										<ul type="i">
											<li>initially contacted Agent to inquire about Principal’s products and or services;</li>
											<li>whose contact information was provided to Principal by Agent;</li>
											<li>who is not an existing client of the Principal;</li>
											<li>and who has not purchased any products or services from Principal within five years prior to the effective date of this Agreement.</li>
										</ul>
									</li>
									<li>Agent’s commission on sales made pursuant to this Agreement shall be up to 50% of true net amount. </li>
									<li>Pre-negotiated changes to the commission rate may be made by written agreement of both Principal and Agent in order to accommodate the closing of a sale.</li>
									<li>If Principal accepts a job such that the percent commission to Agent under the above provisions is greater than the percent profit of the Principal, the percent commission due to Agent will be half of the percent profit of the Principal.</li>
								</ul>
							<h3><li>PURCHASE OF PRODUCTS AND SERVICES BY AGENT</li></h3>
							<p class="para">Principal will provide preferred pricing to Agent should Agent choose to buy and resell Principal’s products itself.  Pricing will depend on product and or service and total shipment frequency and may be negotiated on a case by case basis.</p>
							<h3><li>PAYMENT OF COMMISSIONS</li></h3>
							<p class="para">Any commission to be received under this agreement shall not be payable to Agent until payment in full for the services has been received by Principal.</p>
							<h3><li>AGENT’S EXPENSES</li></h3>
							<p class="para">All expenses for traveling, entertainment, office, clerical, maintenance, and general advertising or selling expenses that may be incurred by Agent in connection with this agreement will be borne wholly by Agent.  In no case shall Principal be liable for expenses incurred by Agent unless negotiated ahead of time and stated in writing.</p>
							<h3><li>LIMIT ON LIABILITY</li></h3>
							<p class="para">The Principal is not liable to Agent for any liability or damages suffered by the Agent resulting from delay or the failure of the Company to deliver any Products and or Services after a shipment has been secured.</p>
							<h3><li>OBJECTIONS TO ACCOUNTING</li></h3>
							<p class="para">Agent agrees that all objections to statements of account rendered by Principal are waived, unless written notice is given by Agent within 15 days of the statement date.</p>
							<h3><li>CONFIDENTIAL INFORMATION</li></h3>
							<p class="para">Agent agrees that all confidential information, including price information, client lists, or any other proprietary information will not be disclosed to third parties for a minimum of 25 years.</p>
							<h3><li>TERMINATION</li></h3>
								<ul type="a">
									<li>This Agreement and the agency created by it may be terminated by either party at any time by written notice.</li>
									<li>Upon termination, Agent must return all loaned or gifted Principal’s products, all documents containing Confidential Information, and any other property belonging to Principal.  All commissions due to Agent may be held until all of Principal’s property has been returned and all outstanding financial transactions have been resolved to the Principal’s satisfaction.</li>
									<li>Upon termination, all claims of commission on sales of Principal’s products, and all claims of any other nature, must be made within 15 days.  Claims of any nature not made within 15 days are waived. </li>
								</ul>
							<h3><li>SUCCESSORS AND ASSIGNS; MODIFICATION</li></h3>
							<p class="para">This Agreement shall be binding upon the heirs, successors and assigns of the parties hereto and shall not be altered or amended in any way except in writing signed by both parties.</p>
							<p class="para">The laws of the State of New Jersey shall be controlling regarding the interpretation and enforcement of the covenants, terms and conditions of this Agreement.</p>
						</ol>
					</p><br><br><br>
					<table style="text-align:center;">
						<tr><td><strong>G. Katen & Partners Company</strong></td><td><strong>'.ucfirst($agg_representative).'</strong></td></tr>
						<tr><td><strong>'.ucfirst($agg_sign1).'</strong></td><td><strong>'.ucfirst($agg_sign2).'</strong></td></tr>
						<tr><td><strong>'.ucfirst($agg_name_title_1).'</strong></td><td><strong>'.ucfirst($agg_name_title_2).'</strong></td></tr>
					</table><br><br>
					<h3>PLEASE ATTACH W-9 FROM SALES REPRESENTATIVE</h3>
					';
	}
// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document


$filename = 'myexpressfreight_'.date('YmdHis').'.pdf';

//$pdf->Output('example_021.pdf', 'I');

$a=$pdf->Output('../generated_forms/'.$filename, 'F');

//echo $a;exit;
		echo "<script type='text/javascript'> document.location='../success.php?filename=$filename';</script>";

//============================================================+
// END OF FILE
//============================================================+
