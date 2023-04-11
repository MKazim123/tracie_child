<?php
/* 
Template Name: List Professional Template 
*/

get_header();

?>

<div class="row">
    
    <div class="col-md-12 detail-hero-section" style="background: #ecf0f9!important">
        <div class="et_pb_row et_pb_row_1">
            <h1>We Help You Find The <span class="blue_txt">Best Professionals</span></h1>
            <div class="search-container">
                <div class="form-group">
                    <span>
                    <input type="text" name="search_profession" value="<?php echo $_GET['profession'] ? $_GET['profession'] : '';?>" id="search_profession" placeholder="What type of Professional are you looking for?">
                    </span>
                    <span>
                        <select name="search-location" id="search_location" class="search-location">
                            <option value="">Select Location</option>
                            <?php
                            // global $wpdb;
                            // $cities = $wpdb->get_col("SELECT DISTINCT(meta_value) FROM $wpdb->usermeta WHERE meta_key = 'user_location'" );
                            // // echo '<pre>';
                            // // print_r($cities);
                            // // echo '</pre>';
                            // foreach($cities as $city){
                            //     if($city == $_GET['location']){
                            //         echo '<option value="'.$city.'" selected>'.$city.'</option>';
                            //     }
                            //     echo '<option value="'.$city.'">'.$city.'</option>';
                            // }
                            ?>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </span>
                    <a href="javascript:void(0)" class="search-professionals">Find Professionals</a>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="et_pb_section et_pb_section_1 et_pb_with_background et_section_regular">
    <div class="et_pb_row et_pb_row_1">
        <div class="et_pb_column et_pb_column_4_4 et_pb_column_1  et_pb_css_mix_blend_mode_passthrough et-last-child">		
            <div class="et_pb_button_module_wrapper et_pb_button_0_wrapper et_pb_button_alignment_right et_pb_module ">
                <?php
                if ( is_user_logged_in() ) {
                    $user_ID = get_current_user_id();
                    $user_type = get_usermeta($user_ID, 'user_type') ? get_usermeta($user_ID, 'user_type') : "admin";
                    if($user_type == "evaluator"){
                        echo '<a class="suggest_professionals" href="javascript:void(0)">Suggest Professional</a>';
                    }
                    elseif($user_type == "professional"){
                        echo '<a class="suggest_professionals professional" href="javascript:void(0)">Suggest Professional</a>';
                    }
                }
                else{
                    echo '<a class="suggest_professionals disabled_btn" href="javascript:void(0)">Suggest Professional</a>';
                }
                ?>
            </div>
        </div> <!-- .et_pb_column -->
                    
                    
    </div>

    <div class="et_pb_row et_pb_row_1">
        <div class="row short-rating-card search_professional_results">
            <?php
                $args1  = array(
                    'meta_key' => 'user_type', //any custom field name
                    'meta_value' => 'professional' //the value to compare against
                );
                
                $total_users= new WP_User_Query( $args1 );
            
                // // echo $total_users->get_total();
                // $paged = get_query_var('paged');
                $number = 9; // ie. 3 users page page 

                global $wpdb;
                // $total_users = count_users();
                // $total_users = $total_users['total_users'];
                $total_users = $total_users->get_total();
                $paged = get_query_var('paged');

                $professionals = get_users(array(
                'meta_key' => 'user_type',
                'meta_value' => 'professional',
                'order'  => 'ASC',
                'count_totals' => true,
                'offset' => $paged ? $number * ($paged - 1):0,
                'number' => $number,    
                ));



                // $professionals = get_users(
                //     array(
                //         'meta_key' => 'user_type',
                //         'meta_value' => 'professional',
                //         'offset' => $paged ? ($paged - 1) * $number : 0,
                //         'number' => $number,
                //     )
                // );

                
                // echo '<pre>';
                // print_r($professionals[0]);
                // echo '</pre>';
                foreach($professionals as $professional){
            ?>
            <div class="col-md-4">
                <div class="card p-3 mb-4">
                    <div class="d-flex justify-content-between card-top">
                        <div class="d-flex flex-row align-items-center" style="column-gap: 12px;">
                            <div class="logo-pic">
                                    <?php echo substr(ucfirst($professional->display_name), 0, 1) ?>
                                    <div class="happy-icon"style="background: url(<?php echo home_url('/wp-content/uploads/2022/06/crown-icon.png'); ?>)">
                                    </div>
                            </div>
                            <div class="ms-2 c-details">
                                <h2 class="mb-0 pb-0"><?php echo ucfirst($professional->display_name); ?></h2> 
                                <span id=profession><?php echo get_usermeta($professional->ID, 'user_profession'); ?></span>
                                <?php
                                $querystr = "SELECT COUNT(id) as total_reviews, AVG(stars) as avg_stars FROM `prof_ratings` WHERE `pro_id`=".$professional->ID." AND `visibility` = 'visible'";
                                $query_results = $wpdb->get_results($querystr);
                                if (!empty($query_results)) {
                                    foreach ($query_results as $results){
                                ?>
                                <span class="fa fa-star checked"><span class="rating-num"> <?php echo round($results->avg_stars); ?></span></span>
                                <?php
                                    }
                                }
                                else{
                                    echo '<span class="fa fa-star checked"><span class="rating-num"> 0</span></span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="reviews"> 
                            <span><span id="c_reviews"><?php echo $results->total_reviews; ?></span> Reviews</span> 
                        </div>
                    </div>
                    <span class="divider"></span>
                    <div class="pro-details">
                        <h3 class="heading">Location</h3>
                        <p><?php echo get_usermeta($professional->ID, 'user_location'); ?></p>
                    </div>
                    <span class="divider"></span>
                    <div>
                        <a href="/tracie/professional-details/?id=<?php echo $professional->ID; ?>" type="button" class="btn btn-primary view-profile">View Profile</a>
                        <?php
                            if ( is_user_logged_in() ) {
                                $user_ID = get_current_user_id();
                                $user_type = get_usermeta($user_ID, 'user_type') ? get_usermeta($user_ID, 'user_type') : "admin";
                                if($user_type == "evaluator"){
                                    echo '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating" pro-id="'.$professional->ID.'">Add Quick Review</a>';
                                }
                                elseif($user_type == "professional"){
                                    echo '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating professional" pro-id="0">Add Quick Review</a>';
                                }
                            }
                            else{
                                echo '<a href="javascript:void(0)" type="button" class="btn btn-outline-primary quick-review add-quick-rating disabled_btn" pro-id="0">Add Quick Review</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>

            <?php
                }

                if($total_users > $number){

                    $pl_args = array(
                       'base'     => @add_query_arg('paged','%#%'),
                       'format'   => '',
                       'total'    => ceil($total_users / $number),
                       'current'  => max(1, $paged),
                       'prev_next' => True,
                        'prev_text' => __( '<' ),
                        'next_text' => __( '>' )
                    );
                  
                    // for ".../page/n"
                    if($GLOBALS['wp_rewrite']->using_permalinks())
                      $pl_args['base'] = user_trailingslashit(trailingslashit(get_pagenum_link(1)).'page/%#%/', 'paged');
                  
                    echo '<div class="mt-5 c_pagination">'.paginate_links($pl_args)."</div>";

                    // $the_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    // $pagination = array(
                    //     'base' => @add_query_arg('paged','%#%'),
                    //     'format' => '?paged=%#%',
                    //     'mid-size' => 1,
                    //     'current' => $the_paged,
                    //     'total' => $total_pages,
                    //     'prev_next' => True,
                    //     'prev_text' => __( '<< Previous' ),
                    //     'next_text' => __( 'Next >>' )
                    // );
                  }
            ?>
    
            <!-- <div class="col-md-4">
                <div class="card p-3 mb-4">
                    <div class="d-flex justify-content-between card-top">
                        <div class="d-flex flex-row align-items-center" style="column-gap: 12px;">
                        <div class="logo-pic">
                                J
                            <div class="happy-icon"style="background: url('http://localhost/tracie/wp-content/uploads/2022/06/crown-icon.png')">
                                </div>
                        </div>
                            <div class="ms-2 c-details">
                                <h2 class="mb-0 pb-0">Jacquline</h2> 
                            <span id=profession>Plumber</span>
                            <span class="fa fa-star checked"><span class="rating-num"> 3.5</span></span>
                            </div>
                        </div>
                    <div class="reviews"> 
                        <span><span id="c_reviews">23</span> Reviews</span> 
                    </div>
                    </div>
                <span class="divider"></span>
                    <div class="pro-details">
                        <h3 class="heading">Location</h3>
                        <p>California University of Pennsylvania,5075 Cameron St. Ste. D Las Vegas , NV 89118</p>
                    </div>
                <span class="divider"></span>
                <div>
                    <a href="/tracie/professional-details/" type="button" class="btn btn-primary view-profile">View Profile</a>
                    <button type="button" class="btn btn-outline-primary quick-review add-quick-rating">Add Quick Review</button>
                </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php get_footer(); ?>