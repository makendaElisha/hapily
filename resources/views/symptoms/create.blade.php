@extends('layouts.app')

@section('content')

    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-12"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Basic Form</h6>
                <div class="mT-30">
                    <form action="{{route('symptom.store', $areaOfLife)}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Symptom name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter Symptom">
                            <p style="color: red;"> @error('name') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label for="instant_help">Instant Help</label>
                            <input type="text" name="instant_help" value="{{old('instant_help')}}" class="form-control" id="instant_help" placeholder="Enter Instant Help">
                            <p style="color: red;"> @error('instant_help') {{$message}} @enderror</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <label for="res_prio">ResPrio</label>
                                <select class="custom-select" id="res_prio" name="res_prio">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="belief">Belief</label>
                            <input type="text" name="belief" value="{{old('belief')}}" class="form-control" id="belief" placeholder="Enter belief">
                            <p style="color: red;"> @error('belief') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label for="recom_book_url">Recommanded book url</label>
                            <input type="text" name="recom_book_url" value="{{old('recom_book_url')}}" class="form-control" id="recom_book_url" placeholder="Enter book url">
                            <p style="color: red;"> @error('recom_book_url') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label for="recom_book_image">Recommanded book image</label>
                            <input type="text" name="recom_book_image" value="{{old('recom_book_image')}}" class="form-control" id="recom_book_image" placeholder="Enter book image">
                            <p style="color: red;"> @error('recom_book_image') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label for="recom_book_description">Recommanded book description</label>
                            <textarea class="form-control" rows="5" name="recom_book_description" class="form-control" id="recom_book_description" placeholder="Enter book description">
                                {{old('recom_book_description')}}
                            </textarea>
                            <p style="color: red;"> @error('recom_book_description') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label for="recom_program_url">Recommanded program url</label>
                            <input type="text" name="recom_program_url" value="{{old('recom_program_url')}}" class="form-control" id="recom_program_url" placeholder="Enter program">
                            <p style="color: red;"> @error('recom_program_url') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label for="recom_program_image">Recommanded program image</label>
                            <input type="text" name="recom_program_image" value="{{old('recom_program_image')}}" class="form-control" id="recom_program_image" placeholder="Enter program">
                            <p style="color: red;"> @error('recom_program_image') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label for="recom_program_description">Recommanded program description</label>
                            <textarea class="form-control" rows="5" name="recom_program_description" class="form-control" id="recom_program_description" placeholder="Type program description">
                                {{old('recom_program_description')}}
                            </textarea>
                            <p style="color: red;"> @error('recom_program_description') {{$message}} @enderror</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Symtpom</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection