<div class="card-body">
    <form action="{{route('admin.contact.index')}}" method="get">
        @csrf
       <div class="row">
           <div class="col-2">
               <div class="form-group">
                    <select name="sort_by" class="form-control">
                    <option value="" selected disabled>Sort by</option>
                    <option value="id">Id</option>
                    <option value="name">Name</option>
                    <option value="created_at">Created At</option>

                    </select>
                </div>
            </div>
           <div class="col-2">
               <div class="form-group">
                    <select name="order_by" class="form-control">
                    <option value="" selected disabled>Order by</option>

                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>

                    </select>
                </div>
            </div>
           <div class="col-2">
               <div class="from-group">
                    <select name="limit_by" class="form-control">
                    <option value="" selected disabled>Limit by</option>

                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="40"> 40</option>

                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                     <select name="status" class="form-control">
                     <option value="" selected disabled>Status</option>
                     <option value="1">Read</option>
                     <option value="0">UnRead</option>

                     </select>
                 </div>
             </div>

           <div class="col-3">
               <div class="form-group">

              <input class="form-control" name="keyword" placeholder="Search Here......" >


                </div>
            </div>
           <div class="col-1">
               <div class="form-group">

                    <button type="submit" class="btn btn-info">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>
