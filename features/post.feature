Feature:
    Scenario: I could create a Post
        Given I am on "/en/login"
        And I fill in "username" with "jane_admin"
        And I fill in "password" with "kitten"
        And I press "submit"
        
        When I am on "/en/admin/post/new"
        And I fill in "post_title" with "Test Post"
        And I fill in "post_summary" with "Test Post Summary"
        And I fill in "post_content" with "Test Content"
        And I press "submit"
        
        Then I should be on "/en/admin/post/"
        And I should see "Test Post"
