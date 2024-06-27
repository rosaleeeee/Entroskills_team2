<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('result_mbti.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <title>Result</title>
    </head>
    <body> 
        @include('layouts.sidebar')
        <form class="container_btn" action="{{ url('/mbti-pdf/' . $user->id) }}" method="GET">
          <button type="submit" class="btn">Downoald PDF</button>
        </form>
        <div class="container_result">
            @php
            if ($results_E >= $results_I) {$v1 = ($results_E) / ($results_E + $results_I);} else {$v1 = ($results_I) / ($results_E + $results_I);}           
            if ($results_F >= $results_T) {$v3 = ($results_F) / ($results_F + $results_T);} else {$v3 = ($results_T) / ($results_F + $results_T);}
            if ($results_N >= $results_S) {$v2 = ($results_N) / ($results_N + $results_S);} else {$v2 = ($results_S) / ($results_N + $results_S);}
            if ($results_P >= $results_J) {$v4 = ($results_P) / ($results_P + $results_J);} else {$v4 = ($results_J) / ($results_P + $results_J);}
            if ($v1 == 0.5) {$v1 =0.51;}
            if ($v2 == 0.5) {$v2 =0.51;}
            if ($v3 == 0.5) {$v3 =0.51;}
            if ($v4 == 0.5) {$v4 =0.51;}
            @endphp

            <h1 class="titre1">Your MBTI Type is: </h1> <br>
            <h1 class="mbti_titre" > {{ $mbti_type }}</h1> <br>
            <div class="x">    
              <div class="container_audio">
                <div class="pie animate no-round" style="--p:{{$v1 * 100}};--c:orange;">{{round($v1 * 100)}}%</div>
                <div class="button-container">
                    @if ($results_E >= $results_I)
                        <button id="playButton1" class="audioButton">Extraversion <img class="image_volume" src="{{ asset('mbti/volume.png') }}" alt=""></button>
                        <audio id="audioPlayer1" style="display: none;">
                            <source src="{{ asset('mbti/e.mp3') }}" type="audio/mpeg">
                        </audio>
                    @else
                        <button id="playButton1" class="audioButton">Introversion <img class="image_volume" src="{{ asset('mbti/volume.png') }}" alt=""></button>
                        <audio id="audioPlayer1" style="display: none;">
                            <source src="{{ asset('mbti/i.mp3') }}" type="audio/mpeg">
                        </audio>
                    @endif
                </div>
            </div>

            <div class="container_audio">
            <div class="pie animate no-round" style="--p:{{$v2 * 100}};--c:orange;">{{round($v2 * 100)}}%</div>
    <div class="button-container">
        @if ($results_N >= $results_S)
            <button id="playButton2" class="audioButton">Intuition<img class="image_volume" src="{{ asset('mbti/volume.png') }}" </button>
            <audio id="audioPlayer2" style="display: none;">
                <source src="{{ asset('mbti/n.mp3') }}" type="audio/mpeg">
            </audio>
        @else
            <button id="playButton2" class="audioButton">Sensing<img class="image_volume" src="{{ asset('mbti/volume.png') }}" </button>
            <audio id="audioPlayer2" style="display: none;">
                <source src="{{ asset('mbti/s.mp3') }}" type="audio/mpeg">
            </audio>
        @endif
    </div>
  </div>

    <div class="container_audio">
    <div class="pie animate no-round" style="--p:{{$v3 * 100}};--c:orange;">{{round($v3 * 100)}}%</div>
    <div class="button-container">
        @if ($results_F >= $results_T)
            <button id="playButton3" class="audioButton">Feeling<img class="image_volume" src="{{ asset('mbti/volume.png') }}" </button>
            <audio id="audioPlayer3" style="display: none;">
                <source src="{{ asset('mbti/f.mp3') }}" type="audio/mpeg">
            </audio>
        @else
            <button id="playButton3" class="audioButton">Thinking<img class="image_volume" src="{{ asset('mbti/volume.png') }}" </button>
            <audio id="audioPlayer3" style="display: none;">
                <source src="{{ asset('mbti/t.mp3') }}" type="audio/mpeg">
            </audio>
        @endif
    </div>
  </div>

    <div class="container_audio">
    <div class="pie animate no-round" style="--p:{{$v4 * 100}};--c:orange;">{{round($v4 * 100)}}%</div>
    <div class="button-container">
        @if ($results_P >= $results_J)
            <button id="playButton4" class="audioButton">Perceiving<img class="image_volume" src="{{ asset('mbti/volume.png') }}" </button>
            <audio id="audioPlayer4" style="display: none;">
                <source src="{{ asset('mbti/p.mp3') }}" type="audio/mpeg">
            </audio>
        @else
            <button id="playButton4" class="audioButton">Judging<img class="image_volume" src="{{ asset('mbti/volume.png') }}" </button>
            <audio id="audioPlayer4" style="display: none;">
                <source src="{{ asset('mbti/j.mp3') }}" type="audio/mpeg">
            </audio>
        @endif
    </div>
  </div>
            </div> 
            <script>
             document.addEventListener('DOMContentLoaded', function() {
    function setupAudioControls(playButtonId, audioPlayerId) {
        var audio = document.getElementById(audioPlayerId);
        var playButton = document.getElementById(playButtonId);

        playButton.addEventListener('click', function() {
            if (audio.paused) {
                audio.play();
            } else {
                audio.pause();
            }
        });
    }

    setupAudioControls('playButton1', 'audioPlayer1');
    setupAudioControls('playButton2', 'audioPlayer2');
    setupAudioControls('playButton3', 'audioPlayer3');
    setupAudioControls('playButton4', 'audioPlayer4');
});
 </script> 
    <br>      <br>                    
   
<button class="titre_et_img_o" onclick="toggleMBTIAudio()">
        <h1 class="titre_et_img">About Your Type</h1>
        <img class="image_volume" src="{{ asset('mbti/volume1.png') }}" alt="Volume Icon">
    </button>    @if ($mbti_type == 'INTJ')
        <p class="info_mbti">INTJs are strategic, analytical, and independent individuals known for their ability to see the big picture and develop long-term plans. They are highly logical and excel at solving complex problems, often using their innovative thinking to create unique solutions. INTJs value intelligence and competence and strive for excellence in everything they do. They prefer to work independently or with a small group of like-minded individuals, valuing efficiency and productivity. Though reserved, INTJs are confident in their abilities and are often seen as visionary leaders. They are driven by a desire to achieve their goals and make significant contributions to their fields. Their decision-making is guided by logic and objective analysis, and they are often critical of inefficiency and incompetence. INTJs enjoy intellectual challenges and are constantly seeking to expand their knowledge and understanding of the world.</p>
    @elseif ($mbti_type == 'INTP')
        <p class="info_mbti">INTPs are analytical, logical, and innovative individuals who excel at understanding complex concepts and solving intricate problems. They are deeply curious and enjoy exploring new ideas and theories, often delving into abstract and theoretical subjects. INTPs value knowledge and are constantly seeking to expand their understanding of the world around them. They are independent thinkers who prefer to work alone or with a small group of like-minded individuals. INTPs are reserved and private, but they are also open-minded and enjoy engaging in intellectual debates and discussions. They are logical and objective, often relying on their analytical skills to make decisions. INTPs are innovative and enjoy finding unique solutions to problems, often thinking outside the box. They are driven by a desire to understand how things work and are often seen as intellectuals and scholars. Their ability to see connections between seemingly unrelated ideas makes them effective problem solvers and thinkers.</p>
    @elseif ($mbti_type == 'INFJ')
        <p class="info_mbti">INFJs are insightful, compassionate, and idealistic individuals who are driven by a deep desire to make a positive impact on the world. They are deeply introspective and value authenticity and integrity in themselves and others. INFJs are often visionaries, with a strong sense of purpose and a passion for helping others. They possess a unique ability to understand the emotions and motivations of those around them, making them empathetic and supportive. INFJs are creative and enjoy expressing themselves through art, writing, or other forms of personal expression. They are often seen as insightful and inspiring leaders, capable of guiding others towards a shared vision. Their decisions are influenced by their values and a deep understanding of human nature. INFJs seek meaningful connections and are dedicated to improving the lives of those they care about. They are often found in roles that allow them to advocate for social causes and bring about positive change.</p>
    @elseif ($mbti_type == 'INFP')
        <p class="info_mbti">INFPs are idealistic, empathetic, and imaginative individuals who are driven by a desire to find and create meaning in their lives. They are deeply introspective and value authenticity and integrity, both in themselves and in others. INFPs are creative and enjoy expressing themselves through writing, art, or other forms of personal expression. They are empathetic and can easily understand the emotions and motivations of others, making them compassionate and supportive friends and partners. INFPs often feel a strong sense of purpose and are passionate about helping others and making a positive impact on the world. They prefer to work independently or in small, close-knit groups, where they can fully express their individuality. Their decisions are guided by their values and a deep understanding of human nature. INFPs are driven by their ideals and are often seen as dreamers, striving to create a better world for themselves and those around them.</p>
    @elseif ($mbti_type == 'ISFJ')
        <p class="info_mbti">ISFJs are loyal, compassionate, and detail-oriented individuals who are deeply committed to helping others and maintaining harmony in their environment. They are known for their reliability and practical approach to problem-solving, often going above and beyond to ensure that the needs of those around them are met. ISFJs are highly empathetic and sensitive to the emotions of others, often putting the well-being of others before their own. They excel in roles that require meticulous attention to detail and a strong sense of duty, often thriving in healthcare, education, and administrative positions. ISFJs value tradition and stability, seeking to preserve and uphold the values and customs that are important to them. They are patient and nurturing, often taking on caregiving roles in their personal and professional lives. ISFJs are modest and prefer to work behind the scenes, often avoiding the spotlight in favor of supporting others. Their decision-making is guided by a strong sense of responsibility and a desire to create a safe and comfortable environment for everyone. ISFJs are dedicated and hardworking, always striving to make a positive impact on the lives of those around them.</p>
    @elseif ($mbti_type == 'ISFP')
        <p class="info_mbti">ISFPs are gentle, creative, and spontaneous individuals who value personal freedom and self-expression. They are known for their artistic talents and a keen appreciation for beauty and aesthetics, often finding joy in creative pursuits such as art, music, and nature. ISFPs are deeply in touch with their emotions and are guided by their personal values and beliefs, often seeking to live a life that is true to themselves. They are empathetic and compassionate, often showing kindness and understanding towards others. ISFPs prefer to live in the moment and enjoy new experiences, often seeking out adventures and opportunities for personal growth. They are independent and prefer to follow their own path rather than conform to societal expectations. ISFPs are sensitive and reserved, often needing time alone to recharge and reflect on their experiences. Their decision-making is guided by their feelings and a desire to create harmony and beauty in their surroundings. ISFPs are flexible and adaptable, often thriving in environments that allow them to explore their creativity and individuality.</p>
    @elseif ($mbti_type == 'ISTJ')
        <p class="info_mbti">ISTJs are dependable, organized, and methodical individuals who excel at creating order and stability in their environment. They are known for their reliability and strong work ethic, often taking on responsibilities and following through on their commitments. ISTJs value tradition and structure, often seeking to uphold and maintain established systems and procedures. They are logical and detail-oriented, often thriving in roles that require precision and accuracy, such as accounting, engineering, or law enforcement. ISTJs are practical and realistic, preferring to focus on concrete facts and practical solutions rather than abstract theories. They are reserved and private, often keeping their personal lives and emotions to themselves. ISTJs value honesty and integrity, often holding themselves and others to high standards of conduct. Their decision-making is guided by a careful analysis of the facts and a consideration of the long-term consequences. ISTJs are dependable and responsible, always striving to fulfill their duties and obligations. They are loyal and committed, often forming strong, lasting relationships based on mutual trust and respect.</p>
    @elseif ($mbti_type == 'ISTP')
        <p class="info_mbti">ISTPs are analytical, practical, and action-oriented individuals who excel at solving problems and understanding how things work. They are known for their technical skills and a hands-on approach to learning and exploring their environment. ISTPs are curious and independent, often seeking out new challenges and opportunities to test their skills. They are logical and observant, able to quickly assess situations and come up with effective solutions. ISTPs value their freedom and autonomy, often preferring to work alone or in environments that allow them to operate independently. They are adaptable and resourceful, often thriving in dynamic and unpredictable situations. ISTPs are reserved and private, often keeping their thoughts and feelings to themselves. Their decision-making is guided by a logical and objective analysis of the facts, and they are skilled at making quick, effective decisions in high-pressure situations. ISTPs enjoy physical activities and often have a strong interest in sports, mechanics, or other hands-on pursuits. They are practical and realistic, always looking for efficient and effective ways to achieve their goals.</p>
    @elseif ($mbti_type == 'ENTP')
        <p class="info_mbti">ENTPs are innovative, curious, and quick-witted individuals who enjoy engaging in intellectual challenges and debates. They are natural problem solvers and excel at thinking on their feet, often coming up with creative and unconventional solutions. ENTPs are highly sociable and enjoy discussing ideas and theories with others, often playing the devil's advocate to stimulate conversation and explore different perspectives. They are enthusiastic and energetic, always looking for new opportunities and experiences. ENTPs value knowledge and are constantly seeking to learn and understand more about the world around them. They are independent thinkers who enjoy exploring new ideas and possibilities, often questioning established norms and conventions. ENTPs are confident and assertive, often taking on leadership roles and inspiring others with their vision and ideas. Their decision-making is guided by logic and rationality, and they are skilled at analyzing complex problems. ENTPs are driven by a desire to innovate and create, always looking for ways to push the boundaries and make a difference.</p>
    @elseif ($mbti_type == 'ENFP')
        <p class="info_mbti">ENFPs are enthusiastic, creative, and sociable individuals who thrive on new experiences and ideas. They are energetic and curious, always eager to explore new possibilities and meet new people. ENFPs are highly empathetic and skilled at understanding others' emotions and perspectives, which makes them excellent communicators and collaborators. They are often seen as inspiring and charismatic, able to motivate and encourage those around them. ENFPs value authenticity and individuality and seek to create a life that is true to their values and beliefs. They enjoy creative expression and often pursue artistic or unconventional careers. ENFPs are adaptable and spontaneous, preferring flexibility over rigid schedules. They are driven by their ideals and a desire to make a positive impact on the world. Their decision-making is influenced by their values and their understanding of human nature. ENFPs are passionate about their interests and are always looking for ways to bring more excitement and meaning into their lives.        </p>
    @elseif ($mbti_type == 'ENTJ')
        <p class="info_mbti">ENTJs are assertive, strategic, and efficient individuals who excel at organizing and leading others towards a common goal. They are natural leaders, known for their confidence, ambition, and ability to think strategically. ENTJs are highly goal-oriented and driven by a desire to achieve success and make a significant impact in their field. They are logical and analytical, often using their problem-solving skills to develop effective plans and strategies. ENTJs value competence and efficiency and expect the same from those around them. They are decisive and confident in their abilities, often taking charge in challenging situations and inspiring others with their vision and determination. ENTJs are skilled at managing and organizing resources, often excelling in leadership and executive roles. Their decision-making is guided by objective analysis and a focus on achieving their goals. ENTJs are driven by a desire to succeed and are often seen as dynamic and influential leaders, capable of making a significant impact on their environment.        </p>
    @elseif ($mbti_type == 'ENFJ')
        <p class="info_mbti">ENFJs are warm, charismatic, and altruistic individuals who are driven by a desire to help others and make a positive impact on the world. They are natural leaders, known for their ability to inspire and motivate those around them. ENFJs are highly empathetic and skilled at understanding others' emotions and needs, often putting the needs of others before their own. They are sociable and enjoy building meaningful connections with others, often taking on mentoring or coaching roles. ENFJs value harmony and cooperation and strive to create a positive and supportive environment for those around them. They are creative and enjoy expressing themselves through art, writing, or other forms of personal expression. ENFJs are driven by their ideals and a desire to make a difference in the lives of others. Their decision-making is guided by their values and a deep understanding of human nature. ENFJs are often seen as inspiring and influential leaders, capable of bringing people together and guiding them towards a shared vision of a better future.        </p>
    @elseif ($mbti_type == 'ESTP')
        <p class="info_mbti">ESTPs are energetic, pragmatic, and action-oriented individuals who thrive in dynamic environments and love to be at the center of the action. They are known for their spontaneity and ability to think on their feet, often excelling in fast-paced situations where quick decisions are required. ESTPs are highly observant and practical, with a knack for understanding the immediate needs of a situation and responding accordingly. They are natural problem-solvers who enjoy hands-on activities and are often skilled in technical or mechanical tasks. ESTPs are charismatic and sociable, often drawing people to them with their enthusiasm and sense of adventure. They enjoy taking risks and are not afraid to challenge the status quo if it means achieving their goals. ESTPs are persuasive and can be very convincing, making them effective in roles that require negotiation or sales. They prefer to live in the moment and seek out new experiences, often getting bored with routine and predictability. ESTPs are direct and straightforward, valuing efficiency and practicality over theoretical concepts. They are independent and self-reliant, often preferring to take the lead and make their own way in the world.  </p>
    @elseif ($mbti_type == 'ESFP')
        <p class="info_mbti">ESFPs are outgoing, fun-loving, and spontaneous individuals who love to live in the moment and enjoy life to the fullest. They are known for their vibrant personalities and ability to bring joy and excitement to any situation. ESFPs are highly social and thrive on interactions with others, often forming close, personal connections with ease. They have a strong appreciation for beauty and aesthetics, often being drawn to artistic and creative pursuits. ESFPs are empathetic and warm, often going out of their way to make others feel comfortable and appreciated. They are practical and realistic, preferring to focus on the here and now rather than worrying about the future. ESFPs are adaptable and flexible, often thriving in environments that allow them to express their creativity and spontaneity. They are energetic and enthusiastic, often being the life of the party and enjoying activities that involve excitement and adventure. ESFPs are sensitive to the needs and feelings of others, often using their charm and sociability to build strong, supportive relationships. They prefer to take a hands-on approach to learning and problem-solving, often relying on their instincts and practical knowledge to navigate challenges.   </p>
    @elseif ($mbti_type == 'ESFJ')
        <p class="info_mbti">ESFJs are warm, caring, and sociable individuals who are deeply committed to helping others and fostering a sense of community. They are known for their empathy and ability to understand and respond to the emotional needs of those around them. ESFJs are practical and organized, often excelling in roles that require attention to detail and a focus on service, such as healthcare, education, or hospitality. They value tradition and stability, often seeking to create and maintain harmonious and supportive environments. ESFJs are sociable and outgoing, often forming close, personal connections with ease and enjoying activities that involve social interaction and teamwork. They are dependable and responsible, often taking their commitments seriously and following through on their promises. ESFJs are detail-oriented and methodical, often excelling in roles that require precision and accuracy. They are empathetic and compassionate, often going out of their way to make others feel comfortable and appreciated. ESFJs are goal-oriented and driven, often setting high standards for themselves and those around them. They are confident and assertive, often being seen as reliable and trustworthy leaders who can be counted on to get the job done.</p>
    @else
        <p class="info_mbti">ESTJs are organized, logical, and decisive individuals who excel at managing people and processes to achieve their goals. They are known for their strong work ethic and ability to create order and efficiency in any situation. ESTJs are practical and realistic, often focusing on concrete facts and evidence to make decisions. They value tradition and structure, often seeking to uphold established systems and procedures. ESTJs are natural leaders who are skilled at organizing and directing others, often taking charge in group situations and ensuring that tasks are completed efficiently. They are dependable and responsible, often taking their commitments seriously and following through on their promises. ESTJs are straightforward and direct, valuing honesty and integrity in themselves and others. They are goal-oriented and driven, often setting high standards for themselves and those around them. ESTJs are detail-oriented and methodical, often excelling in roles that require precision and accuracy, such as management, administration, or law enforcement. They are confident and assertive, often being seen as reliable and trustworthy leaders who can be counted on to get the job done.  </p>
    @endif
    
    {{-- card slider--}}
<script>
        let audio;
        function toggleMBTIAudio() {
            var mbtiType = "{{ $mbti_type }}";
            if (!audio) {
                audio = new Audio("{{ asset('mbti') }}/" + mbtiType + ".mp3");
            }
            if (audio.paused) {
                audio.play();
            } else {
                audio.pause();
            }
        }
    </script>
 <br><br>       
<h1 class="titre_et_img">Public figures have the same MBTI type as you</h1> <br><br>       
<div class="xx">
<div class="wrapper"> 
		<i id="left" class="fa-solid fas fa-angle-left"></i> 
		<ul class="carousel"> 
      @if ($mbti_type == 'INTJ')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTJ1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> elon musk </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTJ2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> michelle obama </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTJ3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> friedrich nietzsche </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTJ4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> christopher nolan </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTJ5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> colin powell </h2> </li>  

      @elseif ($mbti_type == 'INTP')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTP1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> bill gates </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTP2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> albert einstein </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTP3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> kristen stewart </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTP4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> isaac newton </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INTP5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> stanley crouch </h2> </li>  

      @elseif ($mbti_type == 'INFJ')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFJ1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> nelson mandela </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFJ2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> lady gaga </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFJ3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> morgan freeman </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFJ4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> nicole kidman </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFJ5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> martin luther king </h2> </li>
  

      @elseif ($mbti_type == 'INFP')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFP1.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> william shakespeare </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFP2.jpg') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> jony depp </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFP3.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> william wordsworth </h2> </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFP4.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> julia roberts </h2> </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/INFP5.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;">alicia keys </h2> </li>  

      @elseif ($mbti_type == 'ISFJ')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFJ1.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> beyoncé </h2>  </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFJ2.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> queen elizabeth </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFJ3.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> vin diesel </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFJ4.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> halle berry </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFJ5.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> kate middleton </h2>  </li>  
  
      @elseif ($mbti_type == 'ISFP')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFP1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> lana del rey </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFP2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> kevin costner </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFP3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> michael jackson </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFP4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> jeon jungkook </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISFP5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> frida kahlo </h2> </li>  

      @elseif ($mbti_type == 'ISTJ')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTJ1.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> george washington </h2>  </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTJ2.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> anthony hopkins </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTJ3.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> angela merkel </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTJ4.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> denzel washington </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTJ5.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> sting </h2>  </li>  

      @elseif ($mbti_type == 'ISTP')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTP1.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> michael jordan </h2>  </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTP2.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> olivia wilde </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTP3.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> bear grylls </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTP4.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> tom cruise </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ISTP5.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> danielle craig </h2>  </li>  

      @elseif ($mbti_type == 'ENTP')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTP1.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> mark twain </h2>  </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTP2.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> adam savage </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTP3.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> thomas edison </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTP4.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> celine dion </h2>  </li>  
			<li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTP5.jfif') }}"alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> julian sark </h2>  </li>  

       @elseif ($mbti_type == 'ENFP')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFP1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> robert downey jr </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFP2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> will smith </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFP3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> ellen degeneres </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFP4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> quentin tarantino </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFP5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> meg ryanx </h2> </li>  

      @elseif ($mbti_type == 'ENTJ')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTJ1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> steve jobs </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTJ2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> gordon ramsay </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTJ3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> margaret thatcher </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTJ4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> franklin d roosevelt </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENTJ5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> jim carrey </h2> </li>  

      @elseif ($mbti_type == 'ENFJ')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFJ1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> barack obama </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFJ2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> oprah winfrey </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFJ3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> john cusack </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFJ4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> sean connery </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ENFJ5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> maya angelou </h2> </li>  

      @elseif ($mbti_type == 'ESTP')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTP1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> ernest hemingway </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTP2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> jack nicholson </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTP3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> eddie murphy </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTP4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> bruce willis </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTP5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> nicolas sarkozy </h2> </li>  

      @elseif ($mbti_type == 'ESFP')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFP1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> adele </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFP2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> jamie oliver </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFP3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> elton john </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFP4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> jamie foxx </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFP5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> miley cyrus </h2> </li>  

      @elseif ($mbti_type == 'ESFJ')
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFJ1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> taylor swift </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFJ2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> bill clinton </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFJ3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> steve harvey </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFJ4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> danny glover </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESFJ5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> jennifer lopez </h2> </li>  

      @else
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTJ1.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> sonia sotomayor </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTJ2.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> ella baker </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTJ3.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> judje judy </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTJ4.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> john d rockefeller </h2> </li>  
      <li class="card"> <div class="img"><img src="{{ asset('images_mbti/ESTJ5.jfif') }}" alt="" draggable="false"> </div> <h2 style="color: rgb(248, 138, 13); font-weight:bold;"> james monroe </h2> </li>  
      @endif
    </ul> 
		<i id="right" class="fa-solid fas fa-angle-right"></i> 
	</div> 
	</div> 
 <br><br>       

  <script>document.addEventListener("DOMContentLoaded", function() { 
    const carousel = document.querySelector(".carousel"); 
    const arrowBtns = document.querySelectorAll(".wrapper i"); 
    const wrapper = document.querySelector(".wrapper"); 
  
    const firstCard = carousel.querySelector(".card"); 
    const firstCardWidth = firstCard.offsetWidth; 
  
    let isDragging = false, 
      startX, 
      startScrollLeft, 
      timeoutId; 
  
    const dragStart = (e) => { 
      isDragging = true; 
      carousel.classList.add("dragging"); 
      startX = e.pageX; 
      startScrollLeft = carousel.scrollLeft; 
    }; 
  
    const dragging = (e) => { 
      if (!isDragging) return; 
    
      // Calculate the new scroll position 
      const newScrollLeft = startScrollLeft - (e.pageX - startX); 
    
      // Check if the new scroll position exceeds 
      // the carousel boundaries 
      if (newScrollLeft <= 0 || newScrollLeft >= 
        carousel.scrollWidth - carousel.offsetWidth) { 
        
        // If so, prevent further dragging 
        isDragging = false; 
        return; 
      } 
    
      // Otherwise, update the scroll position of the carousel 
      carousel.scrollLeft = newScrollLeft; 
    }; 
  
    const dragStop = () => { 
      isDragging = false; 
      carousel.classList.remove("dragging"); 
    }; 
  
    const autoPlay = () => { 
    
      // Return if window is smaller than 800 
      if (window.innerWidth < 800) return; 
      
      // Calculate the total width of all cards 
      const totalCardWidth = carousel.scrollWidth; 
      
      // Calculate the maximum scroll position 
      const maxScrollLeft = totalCardWidth - carousel.offsetWidth; 
      
      // If the carousel is at the end, stop autoplay 
      if (carousel.scrollLeft >= maxScrollLeft) return; 
      
      // Autoplay the carousel after every 2500ms 
      timeoutId = setTimeout(() => 
        carousel.scrollLeft += firstCardWidth, 2500); 
    }; 
  
    carousel.addEventListener("mousedown", dragStart); 
    carousel.addEventListener("mousemove", dragging); 
    document.addEventListener("mouseup", dragStop); 
    wrapper.addEventListener("mouseenter", () => 
      clearTimeout(timeoutId)); 
    wrapper.addEventListener("mouseleave", autoPlay); 
  
    // Add event listeners for the arrow buttons to 
    // scroll the carousel left and right 
    arrowBtns.forEach(btn => { 
      btn.addEventListener("click", () => { 
        carousel.scrollLeft += btn.id === "left" ? 
          -firstCardWidth : firstCardWidth; 
      }); 
    }); 
  }); 
  </script>
<br><br>
    {{-- jops poropositions --}}
    <h1 class="titre_et_img">Job recommendations based on your MBTI profile</h1>
    <div class="big">
    <div class="container_card">
      @if ($mbti_type == 'INTJ')
      
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Product Manager </h2><p class="contenu_card"> This role requires strategic planning, vision, and the ability to analyze market trends and user needs. INTJs' ability to think ahead and create structured plans makes them well-suited for this position. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/product_manager.png') }}"> <h2>Product Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Sales Manager</h2><p class="contenu_card"> While this role might seem more people-oriented, it also involves setting strategies, analyzing sales data, and optimizing processes. INTJs can bring a strategic and methodical approach to improving sales performance. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/sales_manager.png') }}"> <h2>Sales Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Accountant </h2><p class="contenu_card"> This job involves precision, attention to detail, and logical analysis of financial data, aligning well with the INTJ’s strengths in systematic and organized work. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/accountant.png') }}"> <h2>Accountant</h2></div></div></div>
     
@elseif ($mbti_type == 'INFJ')
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Customer Service Manager</h2><p class="contenu_card"> INFJs' empathy and strong communication skills make them ideal for managing customer relations and ensuring customer satisfaction. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/customer_service_manager.png') }}"> <h2>Customer Service Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Partnerships Manager</h2><p class="contenu_card"> Their ability to form deep connections and understand others' needs makes INFJs effective in managing and developing strategic partnerships. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/partnerships_manager.png') }}"> <h2>Partnerships Manager</h2></div></div></div> 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Project Manager</h2><p class="contenu_card"> INFJs' organizational skills and vision enable them to manage projects effectively, ensuring they align with their values and the company's goals. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/project_manager.png') }}"> <h2>Project Manager</h2></div></div></div>
        
@elseif ($mbti_type == 'INFP') 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Marketing Manager</h2><p class="contenu_card"> INFPs can create authentic and emotionally resonant marketing messages. Their creativity and understanding of human emotions help them connect deeply with audiences. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/marketing_manager.png') }}"> <h2>Marketing Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Operating Officer (COO)</h2><p class="contenu_card"> Although this might seem unconventional, INFPs in this role can focus on creating an organizational culture that aligns with their values, fostering a positive and ethical work environment. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/coo.png') }}"> <h2>Chief Operating Officer (COO)</h2></div></div></div> 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Accountant</h2><p class="contenu_card"> While not typically seen as a creative role, accounting can appeal to INFPs' desire for order and their meticulous nature. They can find satisfaction in ensuring financial accuracy and integrity. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/accountant.png') }}"> <h2>Accountant</h2></div></div></div>
        
@elseif ($mbti_type == 'INTP')
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Financial Officer (CFO)</h2><p class="contenu_card"> INTPs' logical and analytical approach to financial planning and oversight aligns well with the demands of this role. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/cfo.png') }}"> <h2>Chief Financial Officer (CFO)</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Operating Officer (COO)</h2><p class="contenu_card"> INTPs' ability to solve complex problems and optimize processes makes them effective in managing operations and improving efficiency. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/coo.png') }}"> <h2>Chief Operating Officer (COO)</h2></div></div></div> 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Accountant</h2><p class="contenu_card"> INTPs' precision and attention to detail make them well-suited for accounting, ensuring financial accuracy and integrity. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/accountant.png') }}"> <h2>Accountant</h2></div></div></div> 
       
@elseif ($mbti_type == 'ISFJ') 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Customer Service Manager</h2><p class="contenu_card"> ISFJs' empathy and desire to help others make them well-suited for ensuring customer satisfaction and managing customer relations. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/customer_service_manager.png') }}"> <h2>Customer Service Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Accountant</h2><p class="contenu_card"> ISFJs' meticulous nature and strong sense of responsibility align well with the precision and accuracy required in accounting. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/accountant.png') }}"> <h2>Accountant</h2></div></div></div> 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Operating Officer (COO)</h2><p class="contenu_card"> ISFJs' ability to create structure and maintain order makes them effective in overseeing daily operations and ensuring everything runs smoothly. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/coo.png') }}"> <h2>Chief Operating Officer (COO)</h2></div></div></div>
       
@elseif ($mbti_type == 'ISTJ')
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Sales Manager</h2><p class="contenu_card"> ISTJs' reliability and methodical approach make them well-suited for managing sales processes and ensuring targets are met efficiently. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/sales_manager.png') }}"> <h2>Sales Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Financial Officer (CFO)</h2><p class="contenu_card"> ISTJs' attention to detail and systematic approach make them effective in overseeing financial operations and ensuring fiscal responsibility. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/cfo.png') }}"> <h2>Chief Financial Officer (CFO)</h2></div></div></div> 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Accountant</h2><p class="contenu_card"> ISTJs' precision and adherence to rules make them well-suited for ensuring accuracy and compliance in accounting. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/accountant.png') }}"> <h2>Accountant</h2></div></div></div>
       
@elseif ($mbti_type == 'ISFP') 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Customer Service Manager</h2><p class="contenu_card"> ISFPs' warm and friendly nature makes them effective in managing customer relations and ensuring a positive customer experience. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/customer_service_manager.png') }}"> <h2>Customer Service Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Partnerships Manager</h2><p class="contenu_card"> ISFPs' ability to form genuine connections and understand others' needs makes them effective in managing and developing strategic partnerships. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/partnerships_manager.png') }}"> <h2>Partnerships Manager</h2></div></div></div> 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Project Manager</h2><p class="contenu_card"> ISFPs' attention to detail and creativity enable them to manage projects effectively, ensuring they align with their vision and goals. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/project_manager.png') }}"> <h2>Project Manager</h2></div></div></div>
       
      @elseif ($mbti_type == 'ESTP')
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Sales Manager</h2><p class="contenu_card"> ESTPs' dynamic and outgoing nature makes them effective in driving sales, motivating teams, and closing deals. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/sales_manager.png') }}"> <h2>Sales Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Operating Officer (COO)</h2><p class="contenu_card"> ESTPs' practical approach and ability to make quick decisions make them effective in managing operations and ensuring efficient workflow. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/coo.png') }}"> <h2>Chief Operating Officer (COO)</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Customer Service Manager</h2><p class="contenu_card"> ESTPs' people skills and problem-solving abilities make them effective in managing customer relations and ensuring customer satisfaction. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/customer_service_manager.png') }}"> <h2>Customer Service Manager</h2></div></div></div>
     
@elseif ($mbti_type == 'ESFP')
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Marketing Manager</h2><p class="contenu_card"> ESFPs' creativity and ability to connect with people make them effective in creating engaging and memorable marketing campaigns. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/marketing_manager.png') }}"> <h2>Marketing Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Customer Service Manager</h2><p class="contenu_card"> ESFPs' friendly and empathetic nature makes them well-suited for managing customer relations and ensuring a positive customer experience. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/customer_service_manager.png') }}"> <h2>Customer Service Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Partnerships Manager</h2><p class="contenu_card"> ESFPs' ability to form genuine connections and understand others' needs makes them effective in managing and developing strategic partnerships. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/partnerships_manager.png') }}"> <h2>Partnerships Manager</h2></div></div></div>
      
@elseif ($mbti_type == 'ENFP') 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Marketing Manager</h2><p class="contenu_card"> ENFPs' creativity and enthusiasm make them effective in creating innovative marketing strategies that capture audience attention. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/marketing_manager.png') }}"> <h2>Marketing Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Customer Service Manager</h2><p class="contenu_card"> ENFPs' empathetic and outgoing nature makes them well-suited for managing customer relations and ensuring a positive customer experience. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/customer_service_manager.png') }}"> <h2>Customer Service Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Partnerships Manager</h2><p class="contenu_card"> ENFPs' ability to form deep connections and understand others' needs makes them effective in managing and developing strategic partnerships. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/partnerships_manager.png') }}"> <h2>Partnerships Manager</h2></div></div></div>
       
@elseif ($mbti_type == 'ENTP')
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Marketing Manager</h2><p class="contenu_card"> ENTPs' innovative and strategic thinking makes them effective in creating bold and impactful marketing campaigns. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/marketing_manager.png') }}"> <h2>Marketing Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Operating Officer (COO)</h2><p class="contenu_card"> ENTPs' ability to analyze and optimize processes makes them effective in managing operations and ensuring efficiency. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/coo.png') }}"> <h2>Chief Operating Officer (COO)</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Sales Manager</h2><p class="contenu_card"> ENTPs' persuasive skills and ability to think on their feet make them well-suited for managing sales teams and driving revenue growth. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/sales_manager.png') }}"> <h2>Sales Manager</h2></div></div></div>
     
@elseif ($mbti_type == 'ENFJ')
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Marketing Manager</h2><p class="contenu_card"> ENFJs' ability to inspire and connect with people makes them effective in creating compelling marketing strategies that resonate with audiences. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/marketing_manager.png') }}"> <h2>Marketing Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Partnerships Manager</h2><p class="contenu_card"> ENFJs' strong interpersonal skills and ability to understand others' needs make them effective in managing and developing strategic partnerships. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/partnerships_manager.png') }}"> <h2>Partnerships Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Customer Service Manager</h2><p class="contenu_card"> ENFJs' empathy and desire to help others make them well-suited for ensuring customer satisfaction and managing customer relations. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/customer_service_manager.png') }}"> <h2>Customer Service Manager</h2></div></div></div>
     
@elseif ($mbti_type == 'ENTJ')
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Operating Officer (COO)</h2><p class="contenu_card"> ENTJs' leadership skills and strategic vision make them effective in managing operations and driving organizational success. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/coo.png') }}"> <h2>Chief Operating Officer (COO)</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Financial Officer (CFO)</h2><p class="contenu_card"> ENTJs' analytical skills and ability to manage resources strategically make them effective in overseeing financial operations and ensuring fiscal health. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/cfo.png') }}"> <h2>Chief Financial Officer (CFO)</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Sales Manager</h2><p class="contenu_card"> ENTJs' persuasive skills and leadership abilities make them well-suited for driving sales performance and achieving targets. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/sales_manager.png') }}"> <h2>Sales Manager</h2></div></div></div>
      @elseif ($mbti_type == 'ISTP') 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Project Manager</h2><p class="contenu_card"> ISTPs' analytical and problem-solving skills make them effective in managing projects, optimizing workflows, and ensuring timely delivery. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/project_manager.png') }}"> <h2>Project Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Sales Manager</h2><p class="contenu_card"> ISTPs' practical approach and ability to analyze data make them effective in managing sales teams, driving performance, and achieving targets. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/sales_manager.png') }}"> <h2>Sales Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Operating Officer (COO)</h2><p class="contenu_card"> ISTPs' ability to optimize processes and make practical decisions make them effective in managing operations and ensuring efficient workflows. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/coo.png') }}"> <h2>Chief Operating Officer (COO)</h2></div></div></div>
       
@elseif ($mbti_type == 'ESFJ') 
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Financial Officer (CFO)</h2><p class="contenu_card"> ESFJs' organizational skills and attention to detail make them effective in overseeing financial operations and ensuring fiscal responsibility. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/cfo.png') }}"> <h2>Chief Financial Officer (CFO)</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Project Manager</h2><p class="contenu_card"> ESFJs' people skills and ability to coordinate make them effective in managing projects, ensuring teamwork and timely delivery. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/project_manager.png') }}"> <h2>Project Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Partnerships Manager</h2><p class="contenu_card"> ESFJs' ability to build relationships and understand others' needs make them effective in managing strategic partnerships and fostering collaborations. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/partnerships_manager.png') }}"> <h2>Partnerships Manager</h2></div></div></div>
       
@else
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Chief Financial Officer (CFO)</h2><p class="contenu_card"> ESTJs' strong organizational skills and ability to manage resources make them effective in overseeing financial operations and ensuring fiscal discipline. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/cfo.png') }}"> <h2>Chief Financial Officer (CFO)</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Sales Manager</h2><p class="contenu_card"> ESTJs' decisive and goal-oriented approach makes them effective in managing sales teams, setting strategies, and achieving targets. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/sales_manager.png') }}"> <h2>Sales Manager</h2></div></div></div>
      <div class="card"><div class="face face1"><div class="content_card"><h2 class="contenu_card_title">Partnerships Manager</h2><p class="contenu_card"> ESTJs' strong interpersonal skills and strategic mindset make them effective in managing partnerships and driving collaborative efforts. </p></div></div><div class="face face2"><div class="h2_immg"><img class="immg" src="{{ asset('images_mbti/partnerships_manager.png') }}"> <h2>Partnerships Manager</h2></div></div></div>
      @endif
    </div>
  </div>
  <div>    <a href="{{ route('allMbti') }}" class="btnnext">Next</a>
  </div>
    </body>
    </html>
    </x-app-layout>
    