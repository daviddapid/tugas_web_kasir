<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Invoice</title>
   <style>
      .container {
         width: 300px;
      }

      .header {
         margin: 0;
         text-align: center;
      }

      h2,
      p {
         margin: 0;
      }

      .flex-container-1 {
         display: flex;
         margin-top: 10px;
      }

      .flex-container-1>div {
         text-align: left;
      }

      .flex-container-1 .right {
         text-align: right;
         width: 200px;
      }

      .flex-container-1 .left {
         width: 100px;
      }

      .flex-container {
         width: 300px;
         display: flex;
      }

      .flex-container>div {
         -ms-flex: 1;
         /* IE 10 */
         flex: 1;
      }

      ul {
         display: contents;
      }

      ul li {
         display: block;
      }

      hr {
         border-style: dashed;
      }

      a {
         text-decoration: none;
         text-align: center;
         padding: 10px;
         background: #00e676;
         border-radius: 5px;
         color: white;
         font-weight: bold;
      }
   </style>
</head>

<body onload="printOut()">
   <div class="container">
      <div class="header" style="margin-bottom: 30px;">
         <h2>Toko David Gadgetin</h2>
         <small> Jl. David Pekerti No. 19, Bungurasih, Sidoarjo, Jawa Timur</small>
         <img src="/assets/img/poto.jpg" alt="" style="width: 100%; display: block">
      </div>
      <hr>
      <div class="flex-container-1">
         <div class="left">
            <ul>
               <li>No Order</li>
               <li>Kasir</li>
               <li>Tanggal</li>
            </ul>
         </div>
         <div class="right">
            <ul>
               <li> Trx-001 </li>
               <li> {{ $transaction->user->name }} </li>
               <li> {{ $transaction->getDate() }}</li>
            </ul>
         </div>
      </div>
      <hr>
      <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
         <div style="text-align: left;">Nama Product</div>
         <div>Harga/Qty</div>
         <div>Total</div>
      </div>
      @foreach ($transaction->details as $detail)
         <div class="flex-container" style="text-align: right;">
            <div style="text-align: left;">{{ $detail->item->name }}</div>
            <div>Rp {{ number_format($detail->getItemPrice()) }}/{{ $detail->qty }}</div>
            <div>Rp {{ number_format($detail->getSubTotal()) }}</div>
         </div>
      @endforeach
      <hr>
      <div class="flex-container" style="text-align: right; margin-top: 10px;">
         <div>
            <ul>
               <li>Grand Total</li>
               <li>Pembayaran</li>
               <li>Kembalian</li>
            </ul>
         </div>
         <div style="text-align: right;">
            <ul>
               <li>Rp. {{ number_format($transaction->total) }}</li>
               <li>Rp. {{ number_format($transaction->pay_total) }}</li>
               <li>Rp. {{ number_format($transaction->getKembalian()) }}</li>
            </ul>
         </div>
      </div>
      <hr>
      <div class="header" style="margin-top: 50px;">
         <h3>Terimakasih</h3>
         <p>Silahkan berkunjung kembali</p>
      </div>
   </div>
   <script>
      function printOut() {
         window.print()
         setTimeout(() => {
            self.close()
         }, 1000);
      }
      window.onafterPrint = () => {
         window.location.href = "{{ route('transaction.index') }}"
      }
   </script>
</body>



</html>
