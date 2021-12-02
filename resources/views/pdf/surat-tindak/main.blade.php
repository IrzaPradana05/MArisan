<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Example 1</title>
     @include('pdf.surat-tindak.style')
  </head>
  <body>
    @yield('content')
    <script type="text/php">
	  if (isset($pdf)) {
	        $text = "Halaman {PAGE_NUM} / {PAGE_COUNT}";
	        $size = 7;
	        $font = $fontMetrics->getFont("");
	        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
	        
	        $x = ($pdf->get_width() - $width);
	        $y = $pdf->get_height() - 25;
	        $pdf->page_text($x, $y, $text, $font, $size);
	    }
    </script>
   
  </body>
  
  
</html>