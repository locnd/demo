<script src="eway/Rapid.js"></script>

<script>
// eWAY API key & Password
var apiKey = '44DD7CWRgzetjiLUyZftrCbHz+gRi9JuxCcQUGB3ZYpFYXAOPNk0eY80yI9kq4bRMHMafS';
var password = 'hXB23Ucc';
var rapidEndpoint = 'https://api.ewaypayments.com/AccessCodesShared';
    
var client = rapid.createClient(apiKey, password, rapidEndpoint);

client.createCustomer(rapid.Enum.Method.DIRECT, {
   "Title": "Mr.",
   "FirstName": "John",
   "LastName": "Smith",
   "Country": "au",
   "CardDetails": {
     "Name": "John Smith",
     "Number": "4444333322221111",
     "ExpiryMonth": "12",
     "ExpiryYear": "25",
     "CVN": "123"
   }
}).then(function (response) {
    console.log(response);
});
</script>