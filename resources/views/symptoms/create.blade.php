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
                        </div>
                        <div class="form-group">
                            <label for="name">Instant Help</label>
                            <input type="text" name="instant_help" value="{{old('instant_help')}}" class="form-control" placeholder="Enter Instant Help">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <label for="inputCity">ResPrio</label>
                                <select class="custom-select" id="res_prio" name="res_prio" value="{{old('instant_help')}}">
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
                            {{-- <div class="form-group col-md-1">
                                <label for="inputCity">Fear</label>
                                <select class="custom-select" id="fear" name="fear">
                                    <option selected>Fear</option>
                                    <option value="0">0</option>
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
                            <div class="form-group col-md-1">
                                <label for="inputCity">Anger</label>
                                <select class="custom-select" id="anger" name="anger">
                                    <option selected>Anger</option>
                                    <option value="0">0</option>
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
                            <div class="form-group col-md-1">
                                <label for="inputCity">Sadness</label>
                                <select class="custom-select" id="sadness" name="sadness">
                                    <option selected>Sadness</option>
                                    <option value="0">0</option>
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
                            </div> --}}
                        </div>
                        
                                               
                        <div class="form-group">
                            <label for="name">Belief</label>
                            <input type="text" name="belief" value="{{old('belief')}}" class="form-control" id="belief" placeholder="Enter belief">
                        </div>
                        <div class="form-group">
                            <label for="name">Recommanded book url</label>
                            <input type="text" name="recom_book_url" value="{{old('recom_book_url')}}" class="form-control" id="recom_book_url" placeholder="Enter book url">
                        </div>
                        <div class="form-group">
                            <label for="name">Recommanded book image</label>
                            <input type="text" name="recom_book_image" value="{{old('recom_book_image')}}" class="form-control" id="recom_book_image" placeholder="Enter book image">
                        </div>
                        <div class="form-group">
                            <label for="name">Recommanded book description</label>
                            <textarea class="form-control" rows="5" id="comment" name="recom_book_description" class="form-control" id="recom_book_description" placeholder="Enter book description">
                                {{old('recom_book_description')}}
                            </textarea>
                            {{-- <input type="text" name="recom_book_description" value="{{old('recom_book_description')}}" class="form-control" id="recom_book_description" placeholder="Enter book description"> --}}
                        </div>
                        <div class="form-group">
                            <label for="name">Recommanded program url</label>
                            <input type="text" name="recom_program_url" value="{{old('recom_program_url')}}" class="form-control" id="recom_program" placeholder="Enter program">
                        </div>
                        <div class="form-group">
                            <label for="name">Recommanded program image</label>
                            <input type="text" name="recom_program_image" value="{{old('recom_program_image')}}" class="form-control" id="recom_program" placeholder="Enter program">
                        </div>
                        <div class="form-group">
                            <label for="name">Recommanded program description</label>
                            <textarea class="form-control" rows="5" name="recom_program_description" class="form-control" id="recom_program" placeholder="Type program description">
                                {{old('recom_program_description')}}
                            </textarea>
                            {{-- <input type="text" name="recom_program_description" value="{{old('recom_program_description')}}" class="form-control" id="recom_program" placeholder="Enter program"> --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Create Symtpom</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection