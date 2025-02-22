import './bootstrap';


if(role =="user"){
    window.Echo.private('users.'+userId)
       .notification((event)=>{
        let link = showPostRoute.replace(':slug' , event.post_slug) + '?notify=' + event.id;
        $('#push-notification').prepend(`
                                   <div class="dropdown-item d-flex justify-content-between align-items-center">
                                        <span>comment post:${event.post_name.substring(0,9)}</span>
                                        <a href="${ link }?notify=${ event.id }">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>


            `);

            count= Number($('#count-notification').text());
            count++;
            $('#count-notification').text(count);



    });

}



if(role =="admin"){
    window.Echo.private('admins.'+adminId)
       .notification((event)=>{
        $('#notify_push').prepend(`
                <a  class="dropdown-item d-flex align-items-center" href="${ event.link }?notify_admin=${event.id}">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">${event.date}</div>
                        <span class="font-weight-bold">${event.contact_title}</span>
                    </div>
                </a>


            `);

            count= Number($('#notify_count').text());
            count++;
            $('#notify_count').text(count);



    });

}
