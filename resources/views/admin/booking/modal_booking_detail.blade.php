<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
======================= -->
<!--<link rel="stylesheet" type="text/css" href="https://demo.harnishdesign.net/html/koice/vendor/bootstrap/css/bootstrap.min.css"/>-->
<!--<link rel="stylesheet" type="text/css" href="https://demo.harnishdesign.net/html/koice/vendor/font-awesome/css/all.min.css"/>-->
<link rel="stylesheet" type="text/css" href="https://demo.harnishdesign.net/html/koice/css/stylesheet.css"/>
<div class="modal fade" id="modal_booking_detail" tabindex="-1" role="dialog" aria-labelledby="modal_booking_detail" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Booking detail</h4>
                <button id="cmd" onclick="generatePDF()"><i class="fa fa-print">generate PDF</i></button>
            </div>

            <div class="modal-body" id = "modalss">
                  <div class="row align-items-center">
      <div class="col-sm-4 text-center text-sm-start mb-3 mb-sm-0"> <img id="logo" src="{{getImageUrl(setting('logo'))}}" title="Koice" alt="Koice" />   </div>
      <div class="col-sm-3">
      	<p class="text-center mb-3 mb-sm-0" style="color: blue">NSN Hotels</p><br> <p class="text-center mb-3 mb-sm-0" style="color: blue">www.nsnhotels.com<p>
      </div>
       
      <div class="col-sm-4 text-sm-end">
        <!-- <h4 class="mb-0">Invoice</h4> -->
        <p class="mb-0">Booking ID. - <span id="id"></span></p>
        <p class="mb-0">GST NO. - <span >07AAICN0116F1ZW</span></p>

      </div>
    </div>
    <hr>
  </header>
  
  <!-- Main Content -->
  <main>
    <div class="row">
      <div class="col-sm-6 mb-3"> <strong>Guest Name:</strong> <span id="booking_name"></span> </div>
      <div class="col-sm-6 mb-3 text-sm-end"> <strong>Booking Date:</strong> <span id="booking_start"></span> </div>
    </div>
    <hr class="mt-0">
    <div class="row">
      <div class="col-sm-5"> <strong>Hotel Details:<span id="booking_place"></span>></strong>
        <address id="address">
        
        </address>
      </div>
      <div class="col-sm-7">
        <div class="row">
          <div class="col-sm-4"> <strong>Check In:</strong>
            <p class="booking_starts"></p>
          </div>
          <div class="col-sm-4"> <strong>Check Out:</strong>
            <p id="booking_end"></p>
          </div>
          <div class="col-sm-4" id="room"> <strong>Rooms:</strong>
            <p id = "room"></p>
          </div>
          <div class="col-sm-4"> <strong>Booking ID:</strong>
            <p id="id1"></p>
          </div>
          <div class="col-sm-4"> <strong>Payment Mode:</strong>
            <p></p>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="card-header">
            <tr>
              <td class="col-6"><strong>Description</strong></td>
              <td class="col-4 text-end"><strong>Rooms</strong></td>
              <td class="col-2 text-end"><strong>Adult</strong></td>
              <td class="col-2 text-end"><strong>Total Nights</strong></td>
            </tr>
          </thead>
			<tbody>
              <tr>
                <td class="col-6"> Number Of Room & Charges</td>
                <td class="col-4 text-end" id="room2"></td>
                <td class="col-2 text-end" id="booking_numberofadult"></td>
                 <td class="col-2 text-end" id="nights"></td>
              </tr>
              <!--<tr>-->
              <!--  <td>Other Charges</td>-->
              <!--  <td class="text-end">0</td>-->
              <!--  <td class="text-end">0</td>-->
              <!--</tr>-->
              <!-- <tr>
                <td>Promotional Code</td>
                <td class="text-end">SUMMERFUN - <span class="text-1">20.00% One Time Discount</span></td>
                <td class="text-end">-$100.00</td>
              </tr> -->
            </tbody>
			<tfoot class="card-footer">
			  <!--<tr>-->
     <!--           <td colspan="2" class="text-end"><strong>Sub Total:</strong></td>-->
     <!--           <td class="text-end" id="amount1"></td>-->
     <!--         </tr>-->
     <!--         <tr>-->
     <!--           <td colspan="2" class="text-end"><strong>Tax:</strong></td>-->
     <!--           <td class="text-end">0.00</td>-->
     <!--         </tr>-->
			  <tr>
                <td colspan="2" class="text-end border-bottom-0"><strong>Total:</strong></td>
                <td class="text-end border-bottom-0" id="amount"></td>
              </tr>
			</tfoot>
          </table>
        </div>
      </div>
    </div>
    <br>
    <p class="text-1 text-muted"><strong>Please Note:</strong> Amount payable is inclusive of central & state goods & services Tax act applicable slab rates..</p>
  </main>
  <!-- Footer -->
  <footer class="text-center">
    <hr>
    <p><strong>Nsn Hotels Inc.</strong><br>
      . </p>
    <hr>
    <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
    <!--<button id="cmd" onclick="generatePDF()"><i class="fa fa-print">generate PDF</i></button> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"> Print</a> <a href="" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</a> </div>-->
  </footer>
</div>
<!-- Back to My Account Link -->
<p class="text-center d-print-none"><a href="#">&laquo; </a></p>
            </div>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

			function generatePDF() {
				// Choose the element that our invoice is rendered in.
				const element = document.getElementById('modalss');
				// Choose the element and save the PDF for our user.
				html2pdf().from(element).save();
			}
		</script>
</script>
<!--<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>-->
<!--<script type="text/javascript" src="https://code.jquery.com/ui/1.12.0-beta.1/jquery-ui.min.js"></script>-->


