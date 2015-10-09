<?php echo doctype( 'html5' ); ?> 
<html>
	<head>
		<?php echo meta( 'Content-type', 'text/html; charset=utf-8', 'equiv' ); ?>
		<title><?php echo ( isset( $page_title ) ? $page_title : '' ); ?></title>
		<?php
		if ( isset( $page_metatag ) && is_array( $page_metatag ) ) {
			echo "<!-- additional meta tag -->\n";
			foreach ( $page_metatag as $key => $item ) {
				echo $item;
			}
			echo "<!-- end additional meta tag -->\n";
		}
		?>
		
		<?php
		echo link_tag( 'client/themes/'.$this->config->item( 'usetheme' ).'/style-sample.css' );// sample css.
		if ( isset( $page_linktag ) && is_array( $page_linktag ) ) {
			echo "<!-- additional link tag -->\n";
			foreach ( $page_linktag as $key => $item ) {
				echo $item . "\n";
			}
			echo "<!-- end additional link tag -->";
		}
		?>
		
		
		<script src="<?php echo base_url(); ?>client/js/jquery.js" type="text/javascript"></script>
		<?php
		if ( isset( $page_scripttag ) && is_array( $page_scripttag ) ) {
			echo "<!-- additional script tag -->\n";
			foreach ( $page_scripttag as $key => $item ) {
				echo $item;
			}
			echo "<!-- end additional script tag -->\n";
		}
		?>
		
	</head>
	
	<body>


		<!-- start page -->

		<div class="container">
			<h1 class="site-name"><?php echo $this->config_model->load( 'site_name' ); ?></h1>
			<div class="main-column">
				<h2>นี่คืออะไร</h2>
				<p>okvee Web start คือชุดโปรแกรม backend ที่เขียนบน Codeigniter framework. มันไม่ใช่แอปฯประเภท Blog หรือไม่ใช่แม้แต่ CMS แต่มันคือระบบจัดการสมาชิก, ผู้ดูแล, หน้าที่, การอนุญาต เพื่อให้การเริ่มโปรเจคเป็นไปอย่างรวดเร็ว เพราะข้ามการทำระบบสมาชิก, การควบคุมหน้าที่, การอนุญาต ออกไป</p>
				<h3>การทำงานเกี่ยวกับ theme</h3>
				<p>ไฟล์ที่แสดงผลนี้คือไฟล์ของส่วน views ซึ่งอยู่ใน Codeigniter views. (application/views/default/index_view.php)<br />
				คุณสามารถใช้ในรูปแบบ theme ได้โดยลบหรือย้ายไฟล์นี้ใน application/views/default ไปไว้ใน client/themes/default
				</p>
				<p>
				หากต้องการเปลี่ยนชื่อ theme จาก default ไปเป็นอย่างอื่น สามารถกำหนดได้ใน application/config/website.php แล้วจึงสร้าง folder ที่มีชื่อ theme ใหม่นี้ลงใน client/themes<br />
				ตัวอย่าง<br />
				สร้าง folder theme ใหม่ ชื่อ creative ใน client/themes/<strong>creative</strong><br />
				จากนั้นไปกำหนดชื่อ theme ที่จะใช้ใน application/config/website.php ดังนี้<br />
				<code>$config['usetheme'] = 'creative';</code></p>

				<p>&nbsp;</p>
				
				<h3>ลิ้งค์ตัวอย่างที่จำเป็น</h3>
				<p>นี่คือลิ้งค์ตัวอย่างที่จำเป็นสำหรับการเข้าหน้า admin, สมัครสมาชิก, บันทึกเข้า, บันทึกออก, แก้ไขข้อมูลส่วนตัว</p>
				<nav>
					<?php echo anchor( 'site-admin', 'Site admin' ); ?> | 
					<?php
					if ( isset( $is_member_login) && $is_member_login == true ) {
						echo anchor( 'account/profile', 'Edit profile' ) . ' | ';
						echo anchor( 'account/logout', 'Logout' ) . ' ';
					} else {
						echo anchor( 'account/register', 'Register' ) . ' | ';
						echo anchor( 'account/login', 'Login' ) . ' ';
					}
					?>
				</nav>
				<p>สำหรับ source code การเขียนลิ้งค์ตัวอย่างนั้น ขอให้ดูจากไฟล์นี้ใน application/views/default/index_view.php</p>
				<p>&nbsp;</p>
				
				<h3>เริ่มโปรเจค</h3>
				<p>คุณสามารถเริ่มโปรเจคได้ทันที สร้างไฟล์ทับหน้าแรกนี้ที่ client/themes/default/index_view.php ไฟล์ที่ถูกสร้างขึ้นมาใหม่จะถูกโหลดแทนที่ไฟล์นี้โดยอัตโนมัติ<br />
				controller หลักของระบบนี้คือ index. controller ของหน้าแรกนี้จะอยู่ที่ application/controllers/index.php คุณสามารถทำการแก้ไขและเริ่มต้นหน้าแรกได้จากจุดนี้.
				</p>
				<p>
				ใน controller จะมี output array สำหรับใส่ element ต่างๆภายใน &lt;head&gt; แต่คุณไม่จำเป็นต้องใช้วิธีตามตัวอย่างก็ได้ ขอให้ทำอย่างอิสระ.<br />
				การ extends controller ขอให้ใช้ MX_Controller แทนที่จะใช้ CI_Controller เหมือนเก่า เพราะมีข้อดีในการโหลดข้าม controller ได้สะดวกมาก แต่มันก็ไม่จำเป็นเช่นกัน.</p>
				<h4>ส่วนของ admin controller</h4>
				<p>หน้าเพจหรือ controller ใดๆที่ทำงานเป็นหน้า admin หรือ backend ขอให้ใช้การ extends admin_controller เท่านั้น<br />
				นอกจากนี้ยังมีการกำหนด permission หน้า และการกระทำต่างๆสำหรับ permission หน้านัั้น<br />
				ขอให้ดูตัวอย่างการกำหนดค่า permission และการเช็ค permission จาก site-admin/account controller และ blog/site-admin/blog controller</p>
				<footer>
					Peak memory usage: <?php echo ( memory_get_peak_usage( true )/1048576 ); ?>MB
				</footer>
			</div><!--.main-column-->
			
			<div class="side-column">
				<p>ถ้าระบบตัวอย่าง Blog ถูกติดตั้งและมีการเขียนบล็อกแล้ว คุณจะเห็นตัวอย่างการทำงานแสดงผลของ Blog บางส่วนที่นี่.</p>
				<?php
				$this->load->module( array( 'blog' ) );
				if ( method_exists( $this->blog, 'quicklist' ) ) {
					echo $this->blog->quicklist();
				}
				?>
			</div><!--.side-column-->

			<div class="clear"></div>
		</div><!--.container-->
		
		<!-- end page -->


	</body>
</html>