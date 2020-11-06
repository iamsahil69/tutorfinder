# Tutorfinder

TutorFinder is a project created using HTML, CSS ,Javascript ,PHP and Mysql. The main motive behind this project is to help students to find suitable teacher or tutor in their locality whether it will be hometutor or classroom tutor and to help teachers to find students to teach. 

In this project Tutor can come and signup for an account in which he/she will provide his/her information relating to his/her qualification, teaching experience ,expertise in subject and contact information. All this information will act as his/her profile. and will be stored in a 
database and will be retrieved when required. This profile information will be shown to students whose requirements will match with this profile.

Students can do two things by using this project. Firstly they can find tutor related to their interest of study in their locality & can decide which tutor to study from this can be decided based on various factors like locality, qualification and reviews etc about the tutor.

Secondly, they can review a teacher based upon their experience with the concerned tutor.In this review they can give star ratings to the tutor and can give a comment as a feedback which will be very helpful for more students while considering that tutor.This review will also be
useful for tutors as well. As they can improve their teaching by using these valuable feedback from students.   

# Root directory description

css folder: This folder contains all the style related files. These are  css  files. 

images folder: This folder contains all the images which are used in this project. 

javascript folder: This folder contains all the javascript related files which are used to make this project interactive and responsive. 

uploads folder: This folder conatins the images/profile pictures uploaded by the tutors while creating their profiles. 

index.html: This is the home page of this project and contains links for sign up , signin, links to contact us page and blog. 

signup.php: This is the signup page for this project. It ask user to enter three things username, emailId, and password. Appropriate validation is done with php. username must be 5-12 characters alphanumeric and 
can contain @. email should be a valid email Id. Password must be 8-12 characters alphanumeric and can contain @ _(underscore) . 

signin.php: This is the signin page for tutors for signing into their accounts. It ask user to enter username and password. Validation is done with php as in signup page. 

connection.php: This file contain php code which is used to connect to database. 

blog.html: This is blog page of tutorfinder, where information related to tutors is given.

contacts.html: This page contains contact information ,which include phone numbers and emailId incase someone has any query they can contact them. 

registration.php: This page is the first page that will appear after signing in for the firsttime.It will ask for basic information of tutor like name, age, gender, address, city, state, 
highest qualification, specialisation, email, phoneno., profile picture and pincode. All this information is mandatory.Validation for this page is done in php. 

registration2.php: This is the follow up page after registration.php. It will ask tutor for their teaching related information like What type of student they want to teach whether school 
going or college going based on their choice it will ask for school or college board, school class or college course, subjects what tutor can teacher, what type of tutor he/she is whether home    
 tutor or classroom tutor, his/her teaching experience,fees that he/she will charge per subject per month, no.ofhours he/she can teach, his/her tagline, faciltlities that he/she can provide like free
 democlasses, doubt clearing classes etc. Validation for this page is done in php. After completing this page profile creation is completed for tutor. 

profile.php: This is the page that will be shown to the tutor after every signin in their account.This page contains all the information that is provided by tutor while registration process. 

profile2.php: This is profile page of tutor which will shown to students ,this page contains all the neccesary information about the tutor like his/her qualification, teaching experience, comments/reviews about that tutor by differnts students etc.  

find.php:This is first page that will be shown to student when student click on review button on homepage.This page will ask student to enter name, emailid and pincode of the tutor to which student want to give stars and comment.
Validation is done in php. If all the data provided by student is correct student will be redirected to review.php page. 

review.php: This is the page on which the details of tutor to whom student want to review will be given.This page will ask student to enter his/her name, emailid, no.of stars he/she want to give to tutor and the comment that he/she want to share. Validation for this page is done in php. Student can review a teacher only once. 

enquire.php: This is page to which a student will be redirected  when he/she try to find tutor in his/her locality. This page will ask student to enter their requirements whether they want a tutor for school or college going student, what type of board they are studying in?, which subjects they want to study?, what is pincode or locality in which they are looking for tutor?. 
Once they submit all the information, it will be validated and then script will run a database query to find the tutor similar to students requirement and show the resultant tutors on the samepage .Student check the complete profile of tutor by click on "view profile" button. 

result.php:This is the page to which a tutor will be redirected when he/she has successfully signedup for an account. It will ask tutor to complete his/her profile by signing in. 


