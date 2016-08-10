<?php

return [

     /*
    |--------------------------------------------------------------------------
    | Facebook app credentials
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for facebook app that will use
    | fluentfb package api to read and write to facebook social graph.
    |
    */

   'facebook' => [
        'client_id' => env('FB_APP_ID'),
        'client_secret' => env('FB_APP_SECRET'),
        'redirect_uri' => env('FB_REDIRECT_URI'),
    ],

    'user_model' => 'user',
    'user_table_name' => 'users',
    'user_model_namespace' => 'App',

     /*
    |--------------------------------------------------------------------------
    | Facebook api scopes (permissions)
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for facebook app that will use
    | fluentfb package api to read and write to facebook social graph.
    |
    */

    'scopes' => [
        "public_profile" => false,
        "user_friends" => false,
        "email" => true,
        "user_about_me" => false,
        "user_birthday" => false,
        "user_education_history" => false,
        "user_events" => false,
        "user_games_activity" => false,
        "user_hometown" => false,
        "user_likes" => false,
        "user_location" => false,
        "user_managed_groups" => false,
        "user_photos" => true,
        "user_posts" => true,
        "user_relationships" => false,
        "user_relationship_details" => false,
        "user_religion_politics" => false,
        "user_tagged_places" => false,
        "user_videos" => false,
        "user_website" => false,
        "user_work_history" => false,
        "read_custom_friendlists" => false,
        "read_insights" => false,
        "read_audience_network_insights" => false,
        "read_page_mailboxes" => false,
        "manage_pages" => false,
        "publish_pages" => false,
        "publish_actions" => false,
        "rsvp_event" => false,
        "pages_show_list" => false,
        "pages_manage_cta" => false,
        "pages_manage_instant_articles" => false,
        "ads_read" => false,
        "ads_management" => false,
        "business_management" => false,
        "pages_messaging" => false,
        "pages_messaging_phone_number" => false,
    ]
];