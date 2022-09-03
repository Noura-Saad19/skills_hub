# skills_hub

Skillshub is an online skill assessment, Students can test their skills by signing up first in the system and verifying their email, and then they can show categories of exams and in each category, they can show skills of this category, and once they clicked on the skill they can show the exams of this skill then they can enter the exam of any of those skills. 
Once he clicked on the skill he redirected to the exam page and he show the description, difficulty, No. of Questions and Duration " 60 minutes " of the exam, then they can click on the start exam button to start the exam, Once the student submits the exam his score is appeared and returned back to the exam page "he can't start the exam again once he submits it" 

Every Student has a profile, through it he can show the exams he submitted, the scores of those exams, and the duration he took for every exam.

Students can also go back to the system, he can log in and can click on remember me to can login easy every time, and if they forgot the password they can click on forget password and an email is sent to him/her to reset the password, once he clicked of reset password he redirects to the reset password page to enter a new password, then it saved in DB, Students can also sign out.

****Students whose emails are not verified, can't enter the exams
In the point of verification and sending emails I use the Mailtrap testing tool.

Students can also contact admins by going to the contact page and sending messages to them "writing their name, email, subject, and the message".  


On the other hand, Admins and Super Admins login into systems and go to their dashboards, On the Dashboard page, he clicks on anything he showed in the side navbar (Categories, Skills, Students, Exams, Admins, Messages).


On the Categories/Skills page, he can show each of the categories/skills of the system, he can add, edit, delete, and toggle " Change the status of category/skill to yes to appear to students " in each category/skill.
****I use Modal to add new categories or skills either than redirecting to another page to add them. 

On the exam page, admins can see name, skill, and No. of questions of the exam. they can show details of the exam and edit it and show Questions of the exam, edit questions, delete the exam and also toggle the status of the exam "make it active to able to appear to students " 

On The Student Page, he can show all students registered in the system, the exams they submitted, the score of these exams, the duration of time they took, and submitted time.
 Admin can also open again exam to students or closed it.

On the Admin page, "It appears only for super admins" they show all admins and super admins of the system, can promote admins to super admins, or demote super admins to admins. and can delete admins.

On the Message page, admins can show messages that are sent from students and can reply to them 



