@extends('layouts.app')
    @section('main_content')
    <h2> <small>Subject selection</small></h2>
    <div class="container">
      <form action="any action" method="post">
          <div class="form-group col-xs-8">
              <label for="User">User</label>
              <input type="text" class="form-control" id="user" placeholder="Faculty name here">
          </div>
          <div class="form-group col-xs-8">
            <label for="subject">
                <span class="label-text">Subject</span>
                <span class="contact-error"></span>
            </label>
            <select name="subject" class="c-form-profession form-control" id="subject">
                <option value="subject1">subject1</option>
                <option value="subject2">subject2</option>
                <option value="subject3">subject3</option>
                <option value="subject4">subject4</option>
            </select>
          </div>
          <div class="col-xs-8">
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
@endsection
