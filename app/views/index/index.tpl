<body>
  
<div class="module profile-nav wtf-module js-similar-to-module has-content">

  <ul>
    <li class="js-sidenav-link" data-name="similarTo">
      <a class="list-link" href="">
          The list of Twitter Users
        <i class="chev-right"></i>
      </a>
    </li>
  </ul>

  <div class="flex-module">
    <div class="js-recommended-followers dashboard-user-recommendations flex-module-inner" data-section-id="wtf">

    {section name=row loop=$users}
    <div class="js-account-summary account-summary js-actionable-user account-summary-small" data-user-id="{$users[row].userid}" data-feedback-token="1">
      <div class="content">
        <a class="account-group js-recommend-link js-user-profile-link user-thumb" href="" data-user-id="{$users[row].userid}">
          
          <img class="avatar js-action-profile-avatar size32" src="" alt="">
          <span class="account-group-inner js-action-profile-name" data-user-id="21198997">
            <b class="fullname">{$users[row].username}</b>
            <span>?</span>
            
              <span class="username"><s>@</s><span class="js-username">{$users[row].userid}</span></span>
          </span>
        </a>
    
        <small class="metadata social-context">
            
          </small>
    
          <span class="js-follow-state follow-state">
          </span>
    </div>
    {/section}  
    
</div>


    </div>
  </div>

</div>

</body>
