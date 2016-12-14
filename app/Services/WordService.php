<?php 
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
* 
*/
class WordService 
{
	
	function __construct()
	{
		# code...
	}
	/*Công văn quyết định Danh sách sinh viên và đê tài */
	function xuat_cong_van1($filename,$ten_khoa,$sl,$attachfile){
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		/* Note: any element you append to a document must reside inside of a Section. */

		// Adding an empty Section to the document...
		$section = $phpWord->addSection();
		// Adding Text element to the Section having font styled by default...
		$section->addText("	ĐHQG HÀ NỘI  		 CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("TRƯỜNG ĐẠI HỌC CÔNG NGHỆ 			Độc lập - Tự do - Hạnh phúc",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("								      Hà Nội, ngày...tháng...năm...",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'Italic' => true,'align'=>'center'));
		$section->addText("					QUYẾT ĐỊNH",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("		Về việc chốt danh sách đề tài bảo vệ khóa luận tốt nghiệp",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("		   			HIỆU TRƯỞNG",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Xét đề nghị của Trường phòng đào tạo,",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("					QUYẾT ĐỊNH:",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   ĐIỀU 1. Duyệt danh sách ".$sl." sinh viên đại học hệ chính quy khoa ".$ten_khoa." cho phép đăng ký đề tài, chuẩn bị bảo vệ khóa luận vào tháng 6/2017.",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   ĐIỀU 2. Danh sách sinh viên và giáo viên trong file đính kèm có trách nhiệm thi hành công văn này.",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   ĐIỀU 3. File đính kèm: ".$attachfile,
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   									HIỆU TRƯỞNG",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => TRUE,'align' => 'justify'));

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save('download/word/'.$filename.".docx");

	}
	/*tạo file công văn quyết định xin rút đề tài của sinh viên */
	function xuat_cong_van2($filename,$ten_khoa,$ma_sinh_vien,$ten_sinh_vien,$ten_de_tai,$ten_giang_vien){
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		/* Note: any element you append to a document must reside inside of a Section. */

		// Adding an empty Section to the document...
		$section = $phpWord->addSection();
		// Adding Text element to the Section having font styled by default...
		$section->addText("	ĐHQG HÀ NỘI  		 CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("TRƯỜNG ĐẠI HỌC CÔNG NGHỆ 			Độc lập - Tự do - Hạnh phúc",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("								      Hà Nội, ngày...tháng...năm...",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'Italic' => true,'align'=>'center'));
		$section->addText("					QUYẾT ĐỊNH",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("		Về việc cho phép rút đề tài bảo vệ khóa luận tốt nghiệp",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("		   			HIỆU TRƯỞNG ",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Xét đề nghị của Trường phòng đào tạo,",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("					QUYẾT ĐỊNH:",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   ĐIỀU 1. Cho phép sinh viên: ". $ten_sinh_vien ." mã số sinh viên: ".$ma_sinh_vien." rút đề tài: ".$ten_de_tai.", với giảng viên hướng dẫn: ".  $ten_giang_vien,
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   ĐIỀU 2. Các sinh viên và giảng viên có tên trong điều 1 chịu trách nhiệm thi hành công văn này.",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   ĐIỀU 3. Sinh viên: ".$ten_sinh_vien." sẽ không được tái tham gia đăng ký đề tài trong đợt bảo vệ lần đã hủy.",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		
		$section->addText("   									HIỆU TRƯỞNG",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => TRUE,'align' => 'justify'));

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save('download/word/'.$filename.".docx");
	}

	/*tạo file công văn quyết định đổi tên đề tài và giảng viên hướng dẫn cho 1 sinh viên */
	function xuat_cong_van3($filename,$ten_khoa,$ma_sinh_vien,$ten_sinh_vien,$ten_de_tai,$ten_giang_vien, $ten_giang_vien1,$ten_de_tai1){
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		/* Note: any element you append to a document must reside inside of a Section. */

		// Adding an empty Section to the document...
		$section = $phpWord->addSection();
		// Adding Text element to the Section having font styled by default...
		$section->addText("	ĐHQG HÀ NỘI  		 CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("TRƯỜNG ĐẠI HỌC CÔNG NGHỆ 			Độc lập - Tự do - Hạnh phúc",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("								      Hà Nội, ngày...tháng...năm...",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'Italic' => true,'align'=>'center'));
		$section->addText("					QUYẾT ĐỊNH",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("	   Về việc cho phép thay đổi đề tài bảo vệ khóa luận tốt nghiệp",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("		   			HIỆU TRƯỞNG ",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Xét đề nghị của Trường phòng đào tạo,",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("					QUYẾT ĐỊNH:",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   ĐIỀU 1. Cho phép sinh viên: ". $ten_sinh_vien .", mã số sinh viên: ".$ma_sinh_vien." chuyển đề tài: ".$ten_de_tai.", với giảng viên hướng dẫn: ".  $ten_giang_vien ."  thành đề tài: ".$ten_de_tai1. " với giảng viên hướng dẫn: ".$ten_giang_vien1,
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   ĐIỀU 2. Các sinh viên và giảng viên có tên trong điều 1 chịu trách nhiệm thi hành công văn này.",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		
		$section->addText("   									HIỆU TRƯỞNG",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => TRUE,'align' => 'justify'));

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save('download/word/'.$filename.".docx");
	}

	/*tạo file công văn quyết định lập hội đồng phản biện */
	function xuat_cong_van4($filename,$attachfile,$ten_khoa,$sl){
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		/* Note: any element you append to a document must reside inside of a Section. */

		// Adding an empty Section to the document...
		$section = $phpWord->addSection();
		// Adding Text element to the Section having font styled by default...
		$section->addText("	ĐHQG HÀ NỘI  		 CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("TRƯỜNG ĐẠI HỌC CÔNG NGHỆ 			Độc lập - Tự do - Hạnh phúc",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("								      Hà Nội, ngày...tháng...năm...",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'Italic' => true,'align'=>'center'));
		$section->addText("					QUYẾT ĐỊNH",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("	   Về việc phân công phản biện đề tài bảo vệ khóa luận tốt nghiệp",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("		   			HIỆU TRƯỞNG ",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Xét đề nghị của Trường phòng đào tạo,",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("					QUYẾT ĐỊNH:",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   ĐIỀU 1. Phân công phản biện cho các giảng viên với đề tài tương ứng trong danh sách. Số lượng đề tài: ". $sl,
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   ĐIỀU 2. Các sinh viên và giảng viên có tên trong điều 1 chịu trách nhiệm thi hành công văn này.",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		
		$section->addText("   ĐIỀU 3. File đính kèm: ".$attachfile,
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));

		$section->addText("   									HIỆU TRƯỞNG",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => TRUE,'align' => 'justify'));

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save('download/word/'.$filename.".docx");
	}

	/*tạo file công văn quyết định danh sách điểm */
	function xuat_cong_van5($filename,$attachfile,$ten_khoa,$sl){
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		/* Note: any element you append to a document must reside inside of a Section. */

		// Adding an empty Section to the document...
		$section = $phpWord->addSection();
		// Adding Text element to the Section having font styled by default...
		$section->addText("	ĐHQG HÀ NỘI  		 CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("TRƯỜNG ĐẠI HỌC CÔNG NGHỆ 			Độc lập - Tự do - Hạnh phúc",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => true,'align'=>'center'));
		$section->addText("								      Hà Nội, ngày...tháng...năm...",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'Italic' => true,'align'=>'center'));
		$section->addText("					QUYẾT ĐỊNH",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("	   Về việc công bố điểm đề tài bảo vệ khóa luận tốt nghiệp",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("		   			HIỆU TRƯỞNG ",
			array('name' => 'Cambria', 'size' => 14, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Căn cứ Quy định về Tổ chức và hoạt động của các đơn vị thành viên và đơn vị trực thuộc Đại học Quốc gia Hà Nội ban hành quyết định số 3568/QD-DHQGHN ngày 08/10/2014 của Giám đốc Đại học Quốc gia Hà Nội;",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("   Xét đề nghị của Trường phòng đào tạo,",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		$section->addText("					QUYẾT ĐỊNH:",
			array('name' => 'Cambria', 'size' => 16, 'color' => '1B2232', 'bold' => true,'align' => 'justify'));
		$section->addText("   ĐIỀU 1. Công bố danh sách kết quả bảo vệ đề tài khóa luận 2016. với số lượng: ". $sl." Đề tài",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));
		
		$section->addText("   ĐIỀU 2. File đính kèm: ".$attachfile,
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => false,'align' => 'justify'));

		$section->addText("   									HIỆU TRƯỞNG",
			array('name' => 'Cambria', 'size' => 12, 'color' => '1B2232', 'bold' => TRUE,'align' => 'justify'));

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save('download/word/'.$filename.".docx");
	}
}


