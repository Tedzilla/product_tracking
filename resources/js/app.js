/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('bootstrapvalidator');

//Languages
var currenrLang = document.documentElement.lang;
switch (currenrLang) {
    case 'en':
        console.log('en')
        var notEmpty = 'Please fill out that field.',
            notEmptymsg = 'Please fill out that field.',
            validDate = 'Please enter a valid date.',
            emailAddress = 'Please enter a valid email address.',
            phoneNumber = 'Your phone number doesn`t seem correct. Please try it again and enter the phone number as example: 1234-567890.',
            streetNumber = 'Street number should be numeric value',
            zipCode = 'Please enter valid post code',
            passwordValid = 'Password not possible. The password must contain a minimum of 8 characters, uppercase and lowercase letters, numbers, and special characters. Please try again.',
            samePass = 'Passwords do not match.',
            confirmPolicy = 'Yes, I have read and understood the Privacy Policy.',
            formMessage = 'The message must be up to 500 characters.',
            over16 = 'Please confirm that you are over 16 years of age.',
            noMoreProducts = 'NO MORE PRODUCTS',
            moreProducts = 'LOAD MORE ITEMS',
            noMoreNews = 'NO MORE ARTICLES',
            notEmptyDate = 'Please enter your date of birth.',
            notEmptyPhone = 'Please enter your telephone number.',
            notEmptyStreet = 'Please enter your house number.',
            notEmptyZIP = 'Please enter your zip code.',
            notEmptyPass = 'Please enter a password.',
            notEmptyOldPass = 'Please enter your old password.',
            notEmptyNewPass = 'Please enter a new password.',
            notEmptyMessage = 'Please let us know your concerns.',
				notEmptyName = 'Please enter your full name.',
            notEmptyFirstName = 'Please enter your first name.',
            notEmptyLastName = 'Please enter your last name.',
            cookie_text = 'This website uses cookies about web access and marketing analytics. By continuing to use the website you will accept our use of cookies.',
            cookie_link = 'Information about the Cookies and our Privacy Policy.',
            no_results = '<p class="text-center my-3">No results found for your search criteria.</p>',
			checkout_accept = 'Please accept the general Terms & Conditions.',
			checkout_have_read = 'Please accept the Return Policy.',
			checkout_agree = 'Please accept the Data Protection Agreement.';
        break;
    case 'de':
        console.log('de');
        var notEmpty = 'Bitte füllen Sie dieses Feld aus.',
            notEmptymsg = 'Bitte füllen Sie dieses Feld aus.',
            validDate = 'Bitte geben Sie ein korrektes Datum an.',
            emailAddress = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            phoneNumber = 'Bitte geben Sie eine gültige Telefonnummer ein. Zum Beispiel: 1234-567890.',
            streetNumber = 'Die Hausnummer muss ein numerischer Wert sein',
            zipCode = 'Bitte geben Sie eine gültige Postleitzahl an.',
            passwordValid = 'Passwort nicht möglich. Das Passwort muss mindestens 8 Zeichen, Groß- und Kleinbuchstaben, Zahlen und Sonderzeichen enthalten. Bitte versuchen Sie es erneut.',
            samePass = 'Kennwörter stimmen nicht zusammen.',
            confirmPolicy = 'Bitte akzeptieren Sie die Datenschutzbedingungen und AGBs von wunderwerk.',
            formMessage = 'Die Nachricht darf maximal 500 Zeichen enthalten.',
            over16 = 'Bitte bestätigen Sie, dass Sie über 16 Jahre alt sind.',
            noMoreProducts = 'KEINE WEITEREN PRODUKTE',
            moreProducts = 'WEITERE PRODUKTE LADEN',
            noMoreNews = 'KEINE WEITERE ARTIKEL',
            notEmptyDate = 'Bitte geben Sie Ihr Geburtsdatum an.',
            notEmptyPhone = 'Bitte geben Sie Ihre Telefonnummer an.',
            notEmptyStreet = 'Bitte geben Sie Ihre Hausnummer an.',
            notEmptyZIP = 'Bitte geben Sie Ihre Postleitzahl an.',
            notEmptyPass = 'Bitte geben Sie ein Passwort ein.',
            notEmptyOldPass = 'Bitte geben Sie Ihr altes Passwort ein.',
            notEmptyNewPass = 'Bitte geben Sie ein neues Passwort ein.',
            notEmptyMessage = 'Bitte geben Sie eine Nachricht ein.',
				notEmptyName = 'Bitte geben Sie Ihren vollständigen Namen ein.',
            notEmptyFirstName = 'Bitte geben Sie Ihren Vornamen an.',
            notEmptyLastName = 'Bitte geben Sie Ihren Nachnamen an.',
            cookie_text = 'Diese Website verwendet Cookies zur Analyse von Websitezugriffen/Marketingmaßnahmen. Durch die weitere Nutzung der Website stimmen Sie dieser Verwendung zu. ',
            cookie_link = 'Informationen zu Cookies und Ihre Widerspruchsmöglichkeit.',
            no_results = '<p class="text-center my-3">Es konnten keine Ergebnisse gefunden werden.</p>',
			checkout_accept = 'Bitte akzeptieren Sie die Allgemeinen Geschäftsbedingungen.',
			checkout_have_read = 'Bitte akzeptieren Sie die Widerrufsbelehrung.',
			checkout_agree = 'Bitte akzeptieren Sie die Datenschutzvereinbarung.';
        break;
}

//Pass input
$(".show-hide-pass").click(function() {
  $(this).toggleClass("shown");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
//Name Initials
getInitials = function (name) { 
  var parts = name.replace(/[^0-9A-Z]+/gi," ").split(' ')
  var initials = ''
  for (var i = 0; i < parts.length; i++) {
    if (parts[i].length > 0 && parts[i] !== '') {
      initials += parts[i][0]
    }
  }
  return initials
}

$('#user-init').html(getInitials($('#user-name').text()))

//Nav active 
    var current = location.pathname;
    $('nav li a').each(function(){
        var $this = $(this);
        if($this.attr('href').indexOf(current) !== -1){
            $this.parent().addClass('active');
        }
    }) 

//Radio update select
$('#products .radio-filter-status .custom-control-input').on('change', function(){
		if( $(this).is(":checked") ){ 
            var statusVal = $(this).val(); 
        } 
	$('select[name="status_search"]').val(statusVal)
	})
$('#products .radio-filter-state .custom-control-input').on('change', function(){
		if( $(this).is(":checked") ){ 
            var stateVal = $(this).val(); 
        } 
	$('select[name="state_search"]').val(stateVal)
	})
$('#send-form').click(function(){
	$(this).closest('form').submit()
})
$('.search-box .dropdown-menu').click(function(e){
	event. stopPropagation()
})
//clear form data
$('#clearForm').click(function(){
	$(this).closest('form')[0].reset();
})
//modals on load
if($('#showModalOnLoad').length){
	$('#showModalOnLoad').modal('show');
	window.setTimeout(function(){
                     $("#showModalOnLoad").modal('hide')
                  }, 3000);
}
//table
var sortParam = getUrlParameter('sort');
var sortDir = getUrlParameter('direction');
if (sortParam){
	$('.tableList th[data-sort="'+sortParam+'"]').addClass('sortedCol-'+sortDir)
}
$('.add_br a').each(function() {
    var html = $(this).html().split(" ");
    html = html.slice(0, -1).join(" ") + " <br />" + html.pop();
    $(this).html(html);
});
eqWidth($('.pack_price'))
eqWidth($('.piece_price'))
//Form Validation
$('#login-form').bootstrapValidator({
        fields: {
           'email': {
               validators: {
                 notEmpty: {
                     message: emailAddress
                 },
                   emailAddress: {
                       message: emailAddress
                   }
               }
           },
           'password': {
             validators: {
               notEmpty: {
                   message: notEmptyPass
               },
              }
           },
        },
});
$('#email-pass-form').bootstrapValidator({
        fields: {
           'email': {
               validators: {
                 notEmpty: {
                     message: emailAddress
                 },
                   emailAddress: {
                       message: emailAddress
                   }
               }
           },
        },
});
$('#password-reset').bootstrapValidator({
        fields: {
          'password': {
            validators: {
              notEmpty: {
                  message: notEmptyPass
              }
             }
          },
          'password_confirmation': {
            validators: {
              notEmpty: {
                  message: notEmptyPass
              },
              identical: {
                         field: 'password',
                         message: samePass
               },
             }
          },
        },
});
$('#register-form').bootstrapValidator({
        fields: {
			  'email': {
               validators: {
                 notEmpty: {
                     message: emailAddress
                 },
                   emailAddress: {
                       message: emailAddress
                   }
               }
           },
			  'name': {
               validators: {
                 notEmpty: {
                     message: notEmptyName
                 },
               }
           },
          'password': {
            validators: {
              notEmpty: {
                  message: notEmptyPass
              },
             }
          },
          'password_confirmation': {
            validators: {
              notEmpty: {
                  message: notEmptyPass
              },
              identical: {
                         field: 'password',
                         message: samePass
               },
             }
          },
        },
});
$('#add-product').bootstrapValidator({
        fields: {
			  'name': {
               validators: {
                 notEmpty: {
                     message: notEmpty
                 },
               }
           },
			  'artikul_number': {
               validators: {
                 notEmpty: {
                     message: notEmpty
                 },
               }
           },
          'price_per_piece': {
            validators: {
              notEmpty: {
                  message: notEmpty
              },
             }
          },
			  'pieces': {
            validators: {
              notEmpty: {
                  message: notEmpty
              },
             }
          },
			  'package_price': {
            validators: {
              notEmpty: {
                  message: notEmpty
              },
             }
          },
        },
});

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
function eqWidth(onPrice) {
	onPrice.css('width', Math.max.apply(Math, onPrice.map(function(){ return $(this).width(); }).get()));
}