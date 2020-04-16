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
                            <label for="symptom_title">Symptom Title</label>
                            <input type="text" name="symptom_title" value="{{old('symptom_title')}}" class="form-control" id="symptom_title" placeholder="Enter Symptom">
                        </div>
                        <div class="form-group">
                            <label for="title">Instant Help</label>
                            <input type="text" name="instant_help" value="{{old('instant_help')}}" class="form-control" placeholder="Enter Instant Help">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <label for="inputCity">ResPrio</label>
                                <select class="custom-select" id="res_prio" name="res_prio">
                                    <option selected>Res Prio...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
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
                                <label for="inputCity">Fear</label>
                                <select class="custom-select" id="fear" name="fear">
                                    <option selected>Res Prio...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
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
                                    <option selected>Res Prio...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
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
                                    <option selected>Res Prio...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
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
                            <label for="title">Belief</label>
                            <input type="text" name="belief" value="{{old('belief')}}" class="form-control" id="belief" placeholder="Enter belief">
                        </div>
                        <div class="form-group">
                            <label for="title">Recommanded book url</label>
                            <input type="text" name="recom_book_url" value="{{old('recom_book_url')}}" class="form-control" id="recom_book_url" placeholder="Enter book url">
                        </div>
                        <div class="form-group">
                            <label for="title">Recommanded book image</label>
                            <input type="text" name="recom_book_image" value="{{old('recom_book_image')}}" class="form-control" id="recom_book_image" placeholder="Enter book image">
                        </div>
                        <div class="form-group">
                            <label for="title">Recommanded book description</label>
                            <input type="text" name="recom_book_description" value="{{old('recom_book_description')}}" class="form-control" id="recom_book_description" placeholder="Enter book description">
                        </div>
                        <div class="form-group">
                            <label for="title">Recommanded program</label>
                            <input type="text" name="recom_program" value="{{old('recom_program')}}" class="form-control" id="recom_program" placeholder="Enter program">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection