<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<div class="wrapper">
  <div class="container">
    <div class="table-responsive col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Series A</td>
            <td>Product A</td>
            <td>
              <input type="radio" name="radios" id="radio1" />
              <label for="radio1">Yes</label>
            </td>
          </tr>
          <tr>
            <td>Series B</td>
            <td>Product B</td>
            <td>
              <input type="radio" name="radios" id="radio2" />
              <label for="radio2">No</label>
            </td>
          </tr>
          <tr>
            <td>Series C</td>
            <td>Product C</td>
            <td>
              <input type="radio" name="radios" id="radio3" />
              <label for="radio3">Maybe</label>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>

$('.table tr').click(function(event) {
  if (event.target.type !== 'radio') {
    $(':radio', this).trigger('click');
  }
});

$(":radio[name=radios]").change(function() {
  $(".table tr.active").removeClass("active");
  $(this).closest("tr").addClass("active");
});
</script>
<style>
   .wrapper {
  margin-top: 40px;
}
.table-striped {
  background-color: rgba(77, 162, 179, 0.35);
  color: #4DA2B3;
}
.table-responsive {
  border-color: transparent;
  font-size: 20px;
  cursor: pointer;
  /* Remove this if you remove the 3 Last Rules Rules of the CSS */
}
.table tbody tr td {
  line-height: 24px;
  padding-top: 12px;
}
input[type=radio] {
  display: none;
}
label {
  cursor: pointer;
}
input[type=radio] + label:before {
  font-family: 'FontAwesome';
  display: inline-block;
  font-size: 20px;
  font-weight: 200;
}
input[type=radio] + label:before {
  content: "\f10c";
  /* The Open Circle Can be replaced with another Font Awesome Icon */
  color: #4DA2B3;
  cursor: pointer;
}
input[type=radio] + label:before {
  letter-spacing: 10px;
}
input[type=radio]:checked + label:before {
  content: "\f05d";
  /* Replace with f111 for a Solid Circle (or any other Font Awesome Icon */
  color: #fff;
  /* Remove this if you remove the 3 Last Rules of the CSS */
}
/* Delete the Rules Below (and 2 above with Comments) to Remove the Hover Effect and to Make the Buttons + Label the only Active Area */

.table tbody tr:hover td {
  background-color: rgba(77, 162, 179, 0.55);
  color: #fff;
  border-bottom: 10px solid rgba(7, 101, 120, 0.85);
}
.table tbody tr.active td {
  background-color: rgba(77, 162, 179, 0.55);
  color: #fff;
}
.table tbody tr.active td label {
  color: #fff;
} 
input[type=radio] {
    display: none;
}
label {
    cursor: pointer;
}
input[type=radio] + label:before {
    font-family:'FontAwesome';
    display: inline-block;
}
input[type=radio] + label:before {
    content:"\f10c";
    color: #f00;
    cursor: pointer;
}
input[type=radio] + label:before {
    letter-spacing: 10px;
}
input[type=radio]:checked + label:before {
    content:"\f111";
    color: #fff; /* Remove this if you remove the 3 Last Rules of the CSS */
}
</style>