<?php

		$date = date('d/m/Y h:i:s a', time());
		$base_url= base_url('assets/images/img_1');

		$message = '<html>
					<style type="text/css">
					body {
						padding-top: 0 !important;
						padding-bottom: 0 !important;
						padding-top: 0 !important;
						padding-bottom: 0 !important;
						margin: 0 !important;
						width: 100% !important;
						-webkit-text-size-adjust: 100% !important;
						-ms-text-size-adjust: 100% !important;
						-webkit-font-smoothing: antialiased !important;
					}
					.tableContent img {
						border: 0 !important;
						display: block !important;
						outline: none !important;
					}
					a {
						color: #382F2E;
					}
					p, h1 {
						color: #382F2E;
						margin: 0;
					}
					p {
						text-align: left;
						color: #999999;
						font-size: 14px;
						font-weight: normal;
						line-height: 19px;
					}
					a.link1 {
						color: #382F2E;
					}
					a.link2 {
						font-size: 16px;
						text-decoration: none;
						color: #ffffff;
					}
					h2 {
						text-align: left;
						color: #222222;
						font-size: 19px;
						font-weight: normal;
					}
					div, p, ul, h1 {
						margin: 0;
					}
					.bgBody {
						background: #ffffff;
					}
					.bgItem {
						background: #ffffff;
						border: 1px solid rgb(181, 230, 29);
					}
					</style>';
					$message .='<body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center"  style="font-family:Helvetica, Arial,serif;">
					  <tr>
						<td><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="bgItem">
							<tr>
							  <td width="40"></td>
							  <td width="520"><table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
								  <tr>
									<td class="movableContentContainer" valign="top"><div lass="movableContent">
										<table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
										  <tr>
											<td valign="top" align="center">
												<img src="'.$base_url.'/logo.png" width="247" height="90" alt="" data-default="placeholder" data-max-width="560"> 
											  </td>
										  </tr>
										
										</table>
									  </div>
									  <div class="movableContent">
										<table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
										  <tr>
										<td height="55"><p style="text-align:center;margin:0;font-family:Georgia,Time,sans-serif;font-size:26px;color:#222222;">Welcome to <span style="color:#69C374;">My Home</span></p></td>
										  </tr>
										  <tr>
											<td align="left"><div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" align="center">
												 <p style="text-align:center;margin:0 0 10px;font-family:Georgia,Time,sans-serif;font-size:20px;color:#222222;">This email is to communicate with the <span style="color:#69C374;">My Home</span> </p>
												</div>
											  </div></td>
										  </tr>
										  <tr>
										   <td><span style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:30px;"
											>Date</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : '.$date.'</td>
											 
										  </tr>
										  <tr><td><span style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:130px;"
											>Name of Application</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : '.$fullname.'</p></td></tr>
										   <tr>
										   <td><span style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;"
											>Subject</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : '.$subject.'</td>
										  </tr>
										  <tr>
											<td align="left">
											   <br/>
												  <p  style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;">
												  <p style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;">
												  <span style=" color:#000;">Dear Sir or Mam,</span> </p>
												  <p style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;" >
													I am  <strong >'.$fullname.'</strong>
												  </p>
											  <p style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;">'.$usermessage.'</p>
												  <p style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;"
													>I am looking forward for your reply.</p>
												  <br>
												  <p style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;"
													> <span style="font-weight:bold;float:left;">Thanking you,</span><br />
												  '.$fullname.'
												  </p>
												
												  </p>
											  
											  </td>
										  </tr>
										  
										</table>
									  </div>
									  <div class="movableContent">
										<table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
										  <tr>
											<td height="35"></td>
										  </tr>
										  <tr>
											<td  style="border-bottom:1px solid #DDDDDD;"></td>
										  </tr>
										  <tr>
											<td height="3"></td>
										  </tr>
										  <tr>
											<td><table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
												<tr>
												  <td valign="top" align="left" width="370"><div class="contentEditableContainer contentTextEditable">
													  <div class="contentEditable" align="center">
														<p  style="text-align:left;color:#CCCCCC;font-size:12px;font-weight:normal;line-height:20px;"> <span style="font-weight:bold;">MY HOME</span> <br>
														  3015 Grand Ave, Coconut Grove, Merrick Way, FL 12345 <br>
														  Phone: 123-456-7890 <br>
														  <!--<a target="_blank" href="[UNSUBSCRIBE]" class="link1"> <span style="font-weight:bold;">Email: info@yourwebsite.com</span></a> <a target="_blank" href="[FORWARD]"></a><br>-->
														  <br>
														</p>
													  </div>
													</div></td>
												  <td width="30"></td>
												  <td valign="top" width="52"><div class="contentEditableContainer contentFacebookEditable">
													  <div class="contentEditable"> <a target="_blank" href="#"><img src="'.$base_url.'/facebook.png" width="52" height="53" alt="facebook icon" data-default="placeholder" data-max-width="52" data-customIcon="true"></a> </div>
													</div></td>
												  <td width="16"></td>
												  <td valign="top" width="52"><div class="contentEditableContainer contentTwitterEditable">
													  <div class="contentEditable"> <a target="_blank" href="#"><img src="'.$base_url.'/twitter.png" width="52" height="53" alt="twitter icon" data-default="placeholder" data-max-width="52" data-customIcon="true"></a> </div>
													</div></td>
												</tr>
											  </table></td>
										  </tr>
										</table>
									  </div></td>
								  </tr>
								  
								  <!-- =============================== footer ====================================== -->
								  
								</table></td>
							  <td width="40"></td>
							</tr>
						  </table></td>
					  </tr>
					 
					</table>
					</body>
			</html>';
		
