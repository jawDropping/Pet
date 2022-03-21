<?php
    include("inc/function.php");
    echo myProfile();
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
 <style>
            *{
                margin: 0;
                padding: 0;
                
            }
            body{
                background-image: linear-gradient(#5a5bf3, #91e7d9);
                background-repeat: no-repeat;
                height: 100vh;
            }
                form{
                    display: flex;
                    justify-content: center;
                    background: white;
                    width: 90%;
                    margin-left: 5%;
                    height: 95vh;
                    margin-top: 2vh;
                }
                .profileTable{
                  
                    width: 100%;
                    font-family: 'Open Sans', sans-serif;
                
                }
                .contf{
                    display: flex;
                    height: 100%;
                }
                .username{
                    display: block;
                    height: 52px;
                    background: #eee;
                    width: 90%;
                    border-radius: 3px;
                    margin-top: 10px;
                    margin-bottom: 10px;
                   
                }
                .usernameb{
                    display: block;
                    height: 52px;
                    background: #5a5bf3;
                    width: 90%;
                    
                    margin-top: 10px;
                    margin-bottom: 10px;
                   
                }
                .usernameh{
                    display: block;
                    height: 52px;
                    background: #eee;
                    width: 90%;
                  
                    margin-top: 10px;
                    margin-bottom: 10px;
                   
                }
                .user_name{
                    border-radius: 5px;
                    outline: none;
                    border: none;
                    width: 100%;
                    height: 32px;
                    padding-left: 5px;
                    background: #eee;
                }
                .us{
                    font-size: 10px;
                    padding: 5px;
                }
                img{
                    height: 100px;
                    width: 100px;
                    border-radius: 25px;
                    margin-left: 10px;
                    transform: translate(0, 30px);
                }
                button{
                    background: #5a5bf3;
                    height: 42px;
                    width: 100%;
                    border: none;
                    color: white;
                }
                .back{
                    background: #eee;
                    height: 42px;
                    width: 100%;
                   border: none;
                    color: #888;

                }
                .photo{
                    background: #eee;
                    height: 15vh;
                    
                    width: 100%;

                }
                .photo:hover .fileUpload{
                    display: block;
                    transition: 1s ease;
                }
               
                .fileUpload{
                  display: none;
                  margin-left: 10%;
                }
                    .name{
                        font-size: 32px;
                        font-family: "Fredoka", sans-serif;
                        margin-top: 10px;
                        margin-left: 10px;
                    }
                    .formt{
        
                       width: 60%;
                        padding-left: 10%;
                
                    }
                    .rightSide{
                        width:40%;
                        background-image: url("../uploads/myprofile.svg");
                        background-repeat: no-repeat;
                        height: 75%;
                    }

                    @media (max-width: 600px){
                      .formt{
                        margin-top: 0%;
                        height: 100vh;
                        width: 100vw;
                        }
                        img{
                        
                       }
                       .rightSide{
                           display: none;
                       }



            </style>