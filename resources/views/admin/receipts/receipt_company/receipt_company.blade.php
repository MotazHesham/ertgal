<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ertgal</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style media="all">
		@font-face {
            font-family: 'DINNextLTArabic-Medium';
            src: url("{{ asset('css/DINNextLTArabic-Medium.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }
		@page {
			size: auto;   /* auto is the initial value */
			margin: 0;  /* this affects the margin in the printer settings */
		}
        *{
            margin: 0;
            padding: 0;
            line-height: 1.3;
            color: #333542;
        }
		body{
			font-size: .875rem;
			font-family: 'DINNextLTArabic-Medium';
		}
		.gry-color *,
		.gry-color{
			color:#878f9c;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .5rem .7rem;
		}
		table.padding td{
			padding: .7rem;
		}
		table.sm-padding td{
			padding: .2rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align:left;
		}
		.text-right{
			text-align:right;
		}
		.small{
			font-size: .85rem;
		}
		.currency{

		}
	</style>
</head>
<body>
	<div>

		@php
			$generalsetting = \App\Models\GeneralSetting::first();
		@endphp

		<div style="background: #eceff4;padding: 1.5rem;">
			<table>
				<tr>
					<td>
						@if($generalsetting->logo != null)
							<img loading="lazy"  src="{{ asset($generalsetting->logo) }}" height="100" style="display:inline-block;">
						@else
							<img loading="lazy"  src="{{ asset('frontend/images/logo/logo.png') }}" height="40" style="display:inline-block;">
						@endif
					</td>
					<td style="font-size: 2.5rem;" class="text-right strong">Receipt</td>
				</tr>
			</table>
			<table>
				<tr>
					<td style="font-size: 1.2rem;" class="strong">{{ $generalsetting->site_name }}</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small">{{ $generalsetting->address }}</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small">Email: {{ $generalsetting->email }}</td>
				</tr>
				<tr>
					<td class="gry-color small" >Phone: {{ $generalsetting->phone }}</td>
				</tr>
			</table>

		</div>
		<table style="padding: 1.5rem;float: right;position: relative;">
			<img src="{{ asset($generalsetting->logo) }}" alt="" style="position: absolute;opacity:0.15;top:180px;">
			<tr>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{format_Date_Time(strtotime($receipt_company->created_at))}}</span> <span class="gry-color strong" style="float:right">: ?????????? ???? </span></td>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px"><span >{{$receipt_company->Staff ? $receipt_company->Staff->email : ''}}</span> <span class="gry-color strong" style="float:right" >: ????????????</span></td>
			</tr>

			<tr >
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px"><span >{{$receipt_company->order_num}}</span> <span class="gry-color strong" style="float:right" >: ?????? ??????????????</span></td>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{$receipt_company->client_name}}</span> <span class="gry-color strong" style="float:right" >: ?????? ????????????</span></td>
			</tr>

			<tr>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{$receipt_company->order_cost}} @if($receipt_company->order_cost != null ) EGP @endif</span> <span class="gry-color strong" style="float:right"  >: ???????? ??????????????</span></td>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{$receipt_company->phone}} @if($receipt_company->phone2) - {{$receipt_company->phone2}} @endif</span> <span class="gry-color strong" style="float:right" >: ?????? ????????????????</span></td>
			</tr>

			<tr>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{$receipt_company->shipping_country_cost}} @if($receipt_company->shipping_country_cost != null ) EGP @endif</span> <span class="gry-color strong" style="float:right" >: ???????????? ??????????</span></td>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span class="gry-color strong" style="float:right"  >: ???????? ??????????????</span> <br> <div style="font-size: 19px;width:400px;float:right">
					{{$receipt_company->shipping_country_name}} ,
					<br>{{$receipt_company->address}}</div>  </td>
			</tr>

			<tr>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{$receipt_company->deposit}} @if($receipt_company->deposit != null ) EGP @endif</span> <span class="gry-color strong" style="float:right" >: ??????????????</span></td>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{format_Date($receipt_company->date_of_receiving_order)}} </span> <span class="gry-color strong" style="float:right">:  ?????????? ???????????? ?????????? ???? ????????????</span></td>
			</tr>

			<tr>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{$receipt_company->need_to_pay}} @if($receipt_company->need_to_pay != null ) EGP @endif</span> <span class="gry-color strong" style="float:right" >: ?????????????? ????????</span></td>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span >{{format_Date($receipt_company->deliver_date)}} </span> <span class="gry-color strong" style="float:right">:  ?????????? ??????????????</span></td>
			</tr>


		</table>

		<table style="padding: 1.5rem;float: right;position: relative;">
			<tr>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:25px;padding-right:10%;position: relative;" >
					<span style="padding-right: 12px;"> ??????????</span>
					<span class=" strong" style="padding-right: 40px;"><div style=" border: black 1px solid; display:inline;padding:0px 16px"></div></span>
					<span style="padding-right: 12px;"> ?????????? ????????</span>
					<span style="padding-right: 12px;" class=" strong"><div style=" border: black 1px solid; display:inline;padding:0px 16px"></div></span>
				</td>
			</tr>
			<tr>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px" ><span class="gry-color strong">: ???????????? ??????????????</span><br> <span class=" strong" ><?php echo $receipt_company->description;?></span></td>
			</tr>
			<tr>
				<td class="text-right small" style="font-size: 1.2rem;padding-bottom:18px;padding-right:10%;padding-top:15px;position: relative;" >
					<span style="text-align: center;padding:65px">* ?????? ?????????????? *</span><br>
					<div style="padding-top:20px">
						<span style="padding-right: 12px;"> ??????????????</span>
						<span class=" strong" style="padding-right: 40px;"><div style=" border: black 1px solid; display:inline;padding:0px 16px"></div></span>
						<span style="padding-right: 12px;">??????????????</span>
						<span class=" strong" style="padding-right: 12px;"><div style=" border: black 1px solid; display:inline;padding:0px 16px"></div></span>
					</div>
				</td>
			</tr>
		</table>

	</div>

	<script>
		window.print()
	</script>

</body>
</html>
