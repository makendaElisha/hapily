@extends('layouts.app')

@section('content')

    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item col-md-6">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Add Symptom</h6>
                <div class="mT-30">
                    <form>
                        <div class="form-group">
                            <label for="symptom_name">Symptom Name</label>
                            <input type="text" class="form-control" id="symptom_name" placeholder="Symptom name">
                        </div>
                        <div class="form-group">
                            <label for="instant_help">Instant Help</label>
                            <textarea class="form-control" id="instant_help" rows="3"></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="res_prio">Res Prio</label>
                                <select id="res_pro" class="form-control">
                                    <option selected="selected">Choose...</option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                    <option value="4"> 4 </option>
                                    <option value="5"> 5 </option>
                                    <option value="6"> 6 </option>
                                    <option value="7"> 7 </option>
                                    <option value="8"> 8 </option>
                                    <option value="9"> 9 </option>
                                    <option value="10"> 10 </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fear">Fear</label>
                                <select id="fear" class="form-control">
                                    <option selected="selected">Choose...</option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                    <option value="4"> 4 </option>
                                    <option value="5"> 5 </option>
                                    <option value="6"> 6 </option>
                                    <option value="7"> 7 </option>
                                    <option value="8"> 8 </option>
                                    <option value="9"> 9 </option>
                                    <option value="10"> 10 </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="anger">Anger</label>
                                <select id="anger" class="form-control">
                                    <option selected="selected">Choose...</option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                    <option value="4"> 4 </option>
                                    <option value="5"> 5 </option>
                                    <option value="6"> 6 </option>
                                    <option value="7"> 7 </option>
                                    <option value="8"> 8 </option>
                                    <option value="9"> 9 </option>
                                    <option value="10"> 10 </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sadness">Sadness</label>
                                <select id="sadness" class="form-control">
                                    <option selected="selected">Choose...</option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                    <option value="4"> 4 </option>
                                    <option value="5"> 5 </option>
                                    <option value="6"> 6 </option>
                                    <option value="7"> 7 </option>
                                    <option value="8"> 8 </option>
                                    <option value="9"> 9 </option>
                                    <option value="10"> 10 </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sadness">Disgust</label>
                                <select id="sadness" class="form-control">
                                    <option selected="selected">Choose...</option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                    <option value="4"> 4 </option>
                                    <option value="5"> 5 </option>
                                    <option value="6"> 6 </option>
                                    <option value="7"> 7 </option>
                                    <option value="8"> 8 </option>
                                    <option value="9"> 9 </option>
                                    <option value="10"> 10 </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="belief">Belief</label>
                            <input type="text" class="form-control" id="belief" placeholder="Belief">
                        </div>

                        <div class="form-group">
                            <label for="belief">Book Url</label>
                            <input type="text" class="form-control" id="book_url" placeholder="Book URL">
                        </div>

                        <div class="form-group">
                            <label for="belief">Book Image</label>
                            <input type="text" class="form-control" id="book_image" placeholder="Book Image">
                        </div>

                        <div class="form-group">
                            <label for="instant_help">Book Description</label>
                            <textarea class="form-control" id="book_description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="instant_help">Recommanded Program</label>
                            <textarea class="form-control" id="recommanded_program" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Symptom</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection