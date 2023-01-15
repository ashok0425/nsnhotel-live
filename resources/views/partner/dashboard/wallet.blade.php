@extends('partner.layouts.template')
@section('main')

<style>
    /* fonts */
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Roboto:300,400');

* {
	box-sizing: border-box;
}

/* body {*/
/*	margin: 0;*/
/*	-webkit-font-smoothing:antialiased;*/
/*	-moz-osx-font-smoothing:grayscale;*/
/*	background-color: #ffcc66;*/
/*} */

h2 {
	margin: 0px;
	font-weight: 400;
	color: #707584;
	font: 24px/24px 'Open Sans', sans-serif;
}

h3 {
	margin: 0px 0px 5px;
	font-weight: 600;
	font-size: 18px;
	line-height: 18px;
}

.wrapper {
	width: 100vw;
	font-family: 'Open Sans', sans-serif;
	padding: 50px 10px;
}

.app-wrapper {
	background-color: #fff;
	height: 700px;
	max-width: 880px;
	margin: 0 auto;
	border-radius: 8px;
	display: flex;

	-webkit-box-shadow: 0px 8px 24px 4px rgba(255,173,40,1);
	-moz-box-shadow: 0px 8px 24px 4px rgba(255,173,40,1);
	box-shadow: 0px 8px 24px 4px rgba(31,16,234);
}

.wallet {
	width: 360px;
	background-color: #1d4783;
	height: 100%;
	border-top-left-radius: inherit;
	border-bottom-left-radius: inherit;
	padding: 50px;
}

.wallet h2 {
	display:inline-block;
}

.transactions-wrapper {
	width: 520px;
	padding: 50px;
	background-color: #ebebf6;
}

.total-balance {
	display: inline-block;
	float: right;
	font-weight: 600;
	font-size: 32px;
	color: #444750;
}
.total-balance::before {
	content: '₹';
}

.transactions {
	margin-top: 60px;
	border-top: 1px solid #e5e5e5;
	padding-top: 50px;
	height: 550px;
	overflow: scroll;
}

.transactions.show {
	animation: fade-in .3s 1;
}

.transactions::-webkit-scrollbar { 
    display: none; 
}

.transaction-item {
	margin-bottom: 45px;
}

.transaction-item {
	padding-left: 40px;
	position: relative;
	display: flex;
}
.transaction-item::before {
	position: absolute;
	content: '';
	border: 2px solid #e1e1e1;
	border-radius: 50%;
	height: 25px;
	width: 25px;
	left: 0px;
	top: 10px;
	box-sizing: border-box;
	box-sizing: border-box;
	vertical-align: middle;
	color: #666666;
}

.transaction-item.credit::before {
	content: '\002B';
	font-size: 25px;
	line-height: 19px;
	padding: 0px 4px 0px;
}

.transaction-item.credit .transaction-item_amount .amount,
.transaction-item.credit .transaction-item_amount span{
	color: #66cc33;
}

.transaction-item.debit::before {
	content: '\2212';
	font-size: 20px;
	line-height: 21px;
  padding: 0px 5px;
}	

.transaction-item.debit .transaction-item_amount .amount,
.transaction-item.debit .transaction-item_amount span{
	color: #8393ca;
}

.transaction-item span.details {
	font-size: 14px;
	line-height: 14px;
	color: #999;
}

.transaction-item_details {
	width: 270px;
}

.transaction-item_amount {
	width: 110px;
	text-align: right;
}
.transaction-item_amount span {
	font-weight: 600;
	font-size: 18px;
	line-height: 45px;
}

.transaction-item_amount .amount {
	font-weight: 600;
	font-size: 18px;
	line-height: 45px;
	position: relative;
	margin: 0px;
	display: inline-block;
	text-indent: -15px;
}

/* Hide + and - */
.transaction-item_amount .amount::first-letter {
	color: transparent !important;
}

.cards {
	margin-top: 60px;
}

.credit-card {
	  padding: 15px;
    background-color: #ecf1f6;
    margin-bottom: 45px;
		border-radius: 3px;
    border: 2px solid #e1e1e1;
		font-family: 'Roboto', sans-serif;
		cursor: pointer;
		transition: .1s ease-in-out;
}
.credit-card:hover {
	transform: scale(1.07);
}

.credit-card.active {
	border-color: #8393ca;
	border-width: 3px;
}

.card-image {
	display: inline-block;
	height: 40px;
	width: 58px;
	background-repeat: no-repeat;
	background-size: cover;
	border-radius: 3px;
	margin-bottom: 10px;
}

.credit-card.visa .card-image,
.card-image.visa {
	background-image: url("https://nsnhotels.com/uploads/611b66f925593_1629185785.png");
}

.credit-card.amex .card-image,
.card-image.amex {
	background-image: url('https://dl.dropboxusercontent.com/s/e3toeu643kc4xqr/amex.png?dl=0');
}

.credit-card.mc .card-image,
.card-image.mc {
	background-image: url('https://dl.dropboxusercontent.com/s/8uh687u5tcchz9s/mastercard.png?dl=0');
}

.credit-card_expiration {
	color: #b3b3b3;
}

.credit-card_number {
	color: #666666;
}

.card-list {
	margin-top: 20px;
}

.card-list .card-image {
	cursor: pointer;
	margin-right: 15px;
	transition: .1s;
}

.card-list .card-image:hover {
	transform: scale(1.1);
}

.modal {
	display: none;
	position: fixed;
	width: 100vw;
	height: 100vh;
	background-color: rgba(0,0,0,0.7);
	z-index: 1;
	top: 0;
	left: 0;
	text-align: center;
	transition: .2s;
}

.modal.open {
	display: block;
}

.modal-body {
	background-color: #fff;
	border-radius: 5px;
	padding: 35px 15px 25px;
	z-index: 2;
	display: inline-block;
	margin-top: 20%;
	width: 100%;
	max-width: 400px;
	position: relative;
}

.modal-body h3 {
	font: 20px/20px 'Open Sans', sans-serif;
	color: #707584;
}

.modal-control, .modal-close {
	display: inline-block;
	float: right;
	color: #c6cce2;
	font-size: 45px;
	line-height: 22px;
	cursor: pointer;
	transition: color .1s;
}

.modal-control:hover, .modal-close:hover {
	color: #8393ca;
}

.modal-close {
	position: absolute;
	top: 10px;
	right: 10px;
	transform: rotate(45deg);
}

/* animations */
@keyframes fade-in {
	0% {
		opacity: 0;
	}
  100% {
    opacity: 1;
  }
}

/* media queries */
@media(max-width:810px) {
	.wrapper {
		border-radius: 8px;
	}    
	.wallet {
		width: 100%;
		border-top-right-radius: inherit;
		padding-bottom: 25px;
	}
	.cards {
		margin-top: 25px;
	}
	.app-wrapper {
		-webkit-flex-direction: column;
    flex-direction: column;
		width: 100%;
		border-top-right-radius: inherit;
		height: initial;
	}
	.credit-card {
		width: calc(50% - 25px);
    max-width: 260px;
    display: inline-block;
    margin-right: 25px;
		margin-bottom: 25px;
    text-align: left;
	}
	.credit-card:nth-of-type(2) {
		margin-right: 0px;
	}
	.transactions {
		height: initial;
	}
	.transactions-wrapper {
		width: 100%;
	}
	.transaction-item_amount {
		width: calc(100% - 270px);
	}
}

@media(max-width:530px) {
	h3 {
		line-height: 24px;
	}
	.cards {
		text-align: center;
	}
	.credit-card {
		width: calc(100% - 25px);
    max-width: 260px;
	}
	.credit-card:nth-of-type(2) {
		margin-right: 25px;
	}	
	.credit-card:last-of-type {
		margin-bottom: 0px;
	}
	.total-balance {
		    font-size: 22px;
	}
	.transaction-item_amount {
		width: 110px;
	}
}

@media(max-width: 390px) {
	.wallet {
		padding: 50px 25px;
	}
	.transactions-wrapper {
		padding: 50px 25px;
	}
	h2 {
		font: 18px/24px 'Open Sans', sans-serif;
	}
}
</style>
<body>
    <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Detail</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="#">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Detail</li>
                            </ol>
                        </div>
                    </div>
                    <!-- start widget -->
<!--                    <div class="state-overview">-->
<!--<div class="row">-->
  <div class="">
    <div class="app-wrapper">

      <!--Wallet-->
      <aside class="wallet">
        <!--<h2>My Wallets</h2>-->
        <div class="modal-control  btn btn-info" style ="width:220px;"><h2>+ Balance</h2></div>
        <div class="cards"></div>
      </aside>

      <content class="transactions-wrapper">
        <h2>
          Current Balance
          <span class="total-balance"></span>
        </h2>
        <div class="transactions"></div>
      </content>

    </div>

  </div>
  <div class="modal">
    <div class="modal-body">
      <h3>Add Balance in wallet</h3>
      <div class="modal-close"><a href="https://nsnhotels.com/partnercp/partner-wallet" >+</a></div>
      <div class="card-list">
        <!--<div class="card-image visa"></div>-->
        <form method = "get">
            <div class ="form-group">
            <input type ="number" class = "form-control" name ="amount" placeholder = "Please fill amount here">
            </div>
               <div class ="form-group">
            <input type ="text" class = "form-control" name ="remark" placeholder = "Remark" value = "Wallet amount">  
            </div>
              <div class ="form-group">
            <input type = "submit" name = "submit" value = "submit" class ="btn btn-info">
            </div>
        </form>
        <!--<div class="card-image amex"></div>-->
        <!--<div class="card-image mc"></div>-->
      </div>
    </div>
  </div>

</body>

<script>
    var cards = [
	{
		type: "visa",
		number: "2022",
		expiration: "12/2030",
		transactions: [
		    @foreach($wallets as $wallets)
			{
				name: '{{$wallets->name}}',
				type: '{{$wallets->type}}',
				category: '{{$wallets->category}}',
				ID: '#{{$wallets->id}}',
				date: '{{$wallets->created_at}}',
				amount: {{$wallets->amount}}
			},
			@endforeach
		]
	}
];

//Print Cards
function generateCards() {
	var output = "";
	cards.forEach(function(cards, index) {
		output += "<div class='credit-card " + cards.type + "'>";
		output += "<div class='card-image'></div>";
		output += "<div class='credit-card_number'>" + cards.number + "</div>";
		output += "<div class='credit-card_expiration'>Valid Thru:" + cards.expiration + "</div>";
		output += "</div>"
	});
	return output;
}
//Display Cards on Page
document.querySelector('.cards').innerHTML = generateCards();
//Add initial active class
document.querySelector('.credit-card.visa').classList.add('active');;

//Print Cards
function showTransactions(creditCards, card) {
	var output = "";
	var total = 0;
  //if card is active print its transactions from cards data 
	for (var i = 0; i < creditCards.length; i++) {
		if (creditCards[i] === card) {
			for (var n = 0; n < cards[i].transactions.length; n++) {
				output += "<div class='transaction-item " + cards[i].transactions[n].type + "'>";
				output += "<div class='transaction-item_details'>";
				output += "<h3>"+ cards[i].transactions[n].name +"</h3>";
				output += "<span class='details'>"+ cards[i].transactions[n].category + " " + cards[i].transactions[n].ID +" - " + cards[i].transactions[n].date + "</span>";
				output += "</div>";
				output += "<div class='transaction-item_amount'><span class=''>₹ "+ cards[i].transactions[n].amount +"</span></div>";
				output += "</div>";
				//for transaction length add amounts to total 
				total += parseFloat(cards[i].transactions[n].amount);
			}
			document.querySelector('.transactions').innerHTML = output;
			document.querySelector('.total-balance').innerHTML = total.toFixed(2); //2 decimal places
		} 
	}
}

//Grab cardList
var cardsList = document.querySelectorAll('.credit-card');
//Grab single card
var creditCard = document.querySelector( '.credit-card' );
//Grab activeCard
var activeCard = document.querySelector('.credit-card.active');
//Grab transaction
var transaction = document.querySelector('.transactions');

//Show transactions
showTransactions(cardsList, activeCard);

//add class show to transaction div for animation
transaction.classList.add('show')

//Toggle Active class on Cards and show class on transactions
for(let i = 0; i < cardsList.length; i++) {
	cardsList[i].addEventListener("click", function(e) {
		e.preventDefault;
		for(let n = 0; n < cardsList.length; n++) {
			if(cardsList[n].classList.contains('active')) {
				cardsList[n].classList.remove('active');
			}
		}
		this.classList.add('active');
		showTransactions(cardsList, this);

		transaction.classList.remove("show");
		//triggering reflow
		void transaction.offsetWidth;

		transaction.classList.add("show");		
  });
}

//simple modal
var modalControl = document.querySelector('.modal-control');
var modalClose = document.querySelector('.modal-close');
var modal = document.querySelector('.modal');

modalControl.addEventListener('click', function() {
	document.querySelector('.modal').classList.add('open');
}, false);

//click anywhere to close example modal
modal.addEventListener('click', function() {
	document.querySelector('.modal-close').classList.remove('open');
}, false);
</script>


@stop