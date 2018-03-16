@include('frontend.includes.header')

<div class="container">
   <div class="row">
     <div class="col-md-12">
        <h1>Contact Me</h1>
        <hr>
        <form>
          <div class="form-group">
            <label name="email">Email:</label>
            <input id="email" name="email" class="form-control">
          </div>

          <div class="form-group">
            <label name="subject">Subject:</label>
            <input id="subject" name="subject" class="form-control">
          </div>

          <div class="form-group">
            <label name="subject">Message:</label>
            <textarea id="message" name="message" class="form-control"> Type Your Message Here...</textarea>
          </div>

          <input type="submit" value="Send Message" class="btn btn-success">
        </form>
      </div>
    </div>
 </div>

@include('frontend.includes.footer');
  

  
   
   
<