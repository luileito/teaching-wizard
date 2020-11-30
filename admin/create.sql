DROP TABLE methods;
CREATE TABLE methods(id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, description TEXT, pros TEXT, cons TEXT, min_group_size REAL, min_student_workload REAL, min_teacher_workload REAL, min_student_experience REAL, min_teacher_experience REAL, min_student_interaction REAL, max_group_size REAL, max_student_workload REAL, max_teacher_workload REAL, max_student_experience REAL, max_teacher_experience REAL, max_student_interaction REAL);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (1,'Independent work','Students work on a given assignment independently. Can be done at home or during the class, and last from minutes to hours.','- Creates breaks in the teaching sessions  - Forces students to be active  - Students develop their own views','- Creation of the right assignments to support learning  - Choose the right duration os the assigments to keep students motivated',1,1,1,1,2,1,5,2,3,5,5,1);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (2,'Stimulating writing assessments','Give student a reflection time when they write about the course topic, evaluate what they have learned and/or ask questions about the topic to fill their knowledge gaps','- Gives time for student to develop their perspective on the topic - Provides some "time stamps" in the course','- Choose the right assignment to keep students motivated',1,1,1,1,1,1,4,2,2,5,5,1);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (3,'Supplementary reading','Give extra material for the students to read to deepen their knowledge about the course topic','- No extra work for the teacher - Gives students a wider perspective about the course topic - Gets them excited about the course topic','- Find the right material to promote learning - Comes as an extra workload for the students',1,2,1,1,1,1,5,3,1,5,5,1);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (4,'Summaries','Let students draft summaries about the course topic to deepen their understanding. Can come in various forms (writing, drawing, etc.), can be individual or discussed in groups','- Forces students to analyze the subject  - Comes as a help for the student (to revise things for instance)','- Student must do this work personally ( not taking it from others) to be effective  - Not easy to activate deep learning',1,1,1,3,1,1,5,1,2,5,5,2);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (5,'Assembling knowledge base','Students think about essential gaps in their knowledge related to the course, and then discuss these gaps in small groups','- The group is used as peer support  - Student learn to justify their views','- Group dynamics  - Not easy to ensure all groups are successful',1,3,1,3,2,4,5,5,2,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (6,'Group work','Small groups of student work independently on tasks (the teacher is not involved but just plans and assess the work)','- Develop working skills for the students  - Peer learning  - Can facilitate deep learning approaches  - Value of a group can be more than the sum of the values of its parts','- Group dynamics  - Not easy to ensure all groups are successful',1,3,2,1,3,4,5,5,3,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (7,'Cross-over groups','Divide groups each achieving a sub-task of the problem. Then redistribute groups so that each group counts at leat a member of the previous group to combine works','- Help students to commit to their task  - Develop skills to share knowledge  - Supports cummulative learning','- Create the right assignments for each group  - Guidance (balance the fact that you have to give the room for ideas and at the same time achieve objectives)',1,3,1,3,3,4,4,4,2,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (8,'Learning café','Students discuss in small groups in a "cafe" athmosphere and a secretary takes notes. Groups are redistributed regularly to keep the discussion going, only the secretary stays at the same table','- Keep students active  - The discussion progresses as the group are evolving','- Inequal status of students (secretary stsys always at the same table)  - Find suitable discussion topics for the students',1,2,1,2,1,3,4,2,2,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (9,'Cummulative groups','Divide students in pairs discussing a given problem. Then group two pairs together to enrich the discussion. Then progressively double the size of each groups and continues the discussion, until the whole class is together','- Students share views with an increasingly large audience and learn from a variety of other groups  - Students have the possibility to learn from others','- hard to produce high quality work with groups',1,2,1,1,1,4,5,2,2,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (10,'Presentation walk','Divide students in groups and ask each group to produce a poster. Then redistribute the groups with at least one student of each previous groups in the new groups. Each groups succesively walks around each poster and discuss them.','- Every student must be involved in the building process of the poster (because each student present it during the walk)  - Not more time-consumming than other group works  - Discussion possibilites during the walk','- All discussions are hard to follow for the teacher  - Forming good groups',2,2,1,1,2,3,3,3,2,5,5,4);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (11,'Brainstorming','Students are divided in small groups discussing a particular issue. Each member write preliminary ideas and present them without being critisized. Then ideas are brought together in the group and criticized.','- Students can develop their own thinking  - Students experience various ways of approaching a problem and even crazy ideas are welcome - can also help more silent students to speak','- Hard to develop good ideas in the discussion  - Ideas being developed and discussed can''t be predicted by the teacher',1,2,2,1,2,4,4,3,3,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (12,'Discussion groups','Give a bit of time for students to discuss a topic in small groups','- Activates students  - Breaks rythm and creates discussion  - Does not require much preparation for the teacher','- teacher should come up with good discussion topic',1,2,2,3,2,4,4,3,3,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (13,'Reading circle','Students meet regularly, just in between peers, to discuss about something they read related to the class and take notes','- Easy for the teacher  - Students can interact in between peers','- Selection of good reading material  - Can have limited success',1,3,1,2,1,3,5,4,1,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (14,'Lecturing','Monologue presentation on a given course topic','- Teacher can organize presented information  - Can be planned, quick, simple  - Comfortable also for students','- Teacher is in control of the knowledge  - Not challenging for students (and teacher)  - does not guarantee good learning  - See students as a homogenious group',1,1,2,1,1,1,5,1,3,5,5,1);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (15,'Pretest','Make a pretest before a course to evaluate students'' level','- Assess student knowledge about the topic  - Teacher can orient the course','- Gathered info is hard to use for the teacher  - Assessment is to be carefully considered',1,2,1,1,1,1,5,2,2,5,5,1);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (16,'Panel discussion','Make a panel discussion as in a conference, experts sitting and audience listening and asking questions','- Each participant shows his/her view  - Audience can react  - Creates some tension in the discussions','- Preparation/selection of the panelists  - Chairing is challenging  - Creates tension',2,3,2,2,2,4,4,5,3,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (17,'Participants teach','Participants prepare a teaching session where they are teaching a given topic to others. Teachers gives support in the preparation','- Students have an active role  - Encourages students to deeply understand the topic they teach  - Frees teacher from explaining the basics and focuses on guiding the discussion   - Supports the development of students'' performance and teaching skills','- One student is active at a time  - the student preparing the course is the one who understands that topic the most  - Ensure right level of teaching for other students  - Guidance of students when they prepare their talk  - Students must respect each other during sessions',1,5,1,1,1,2,3,5,2,5,5,3);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (18,'Learning diary','Writing a diary about each course day','-Very helpful for the teacher (can get feedback and redesign according to it). -Student has to think critically what he learned, revise the course in his brain and remember what he learned','-It takes time to do it, usually students not very motivated. It takes time for teacher to go through.',2,4,3,1,1,1,3,4,3,5,1,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (19,'Inquiry Teaching','Inquiry teaching has plenty of ways of implementation. The questions may be posed by the teacher or the students. Inquiry teaching may also be carried out among the students. The questions can either be given to the students beforehand, giving them time for preparation, they can be formed together, or created spontaneously in the teaching situation.','- very pleasant for the student, requires interaction-Unique opportunity for the student to design a course from their own point of view','Very demanding for teacher (time consuming and mentally tough)',1,2,3,4,4,5,1,2,5,5,4,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (20,'Teaching discussion','Bothe the teacher and the student bear the responsibility for the success of teaching discussion. It can be applied in teaching situations, in which taking the other’s opinions into consideration, forming own thoughts, learning from others, developing discussion skills and solving problems together are essential','Promotes active participation and communication skills for the students and leadership skills for eacher','Challenging for all sides',1,2,2,3,4,3,3,2,2,5,4,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (21,'Debate with Argumentation','In a debate, two opposing groups or individuals are chosen, who then present their own views on the chosen theme and give counter-arguments to the opposing views. The students practice presenting justifications and arguments for their own opinions and evaluating other people’s opinions. The goal is to deepen the own understanding.','Promotes critical thinking, and argumentation skills. - Involves all students','-',1,4,1,3,5,3,3,4,1,5,5,3);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (22,'Fishbowl','A part of the group is chosen as a discussion group or groups for this method. The other students in the teaching group form the audience for the discussion.','Promotes discussion and perform in big audiences.- Improves communicational and social skills','Demanding for the students, it requires preparation. - mentally demanding too',1,4,1,4,2,3,2,4,1,5,4,3);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (23,'Problem-based learning','The purpose of the problems is to start the learning process and to challenge the students to work together to achieve learning.','Introduces students to the working reality.- Accelerates learning by applying knowledge into working reality','Very demanding for students. It requires experienced teachers to navigate/coordinate',1,5,2,3,2,5,5,5,2,5,2,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (24,'Case teaching','In case teaching, the students are given a case that they will start to process either independently or in groups and make conclusions and generalisations based on it.','Pleasant and useful for students.- It promotes critical approach from the student','Requires a lot of preparation from teacher',1,2,5,4,1,5,3,2,5,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (25,'Project work','An individual or a group is given a project to work on, or the students can be allowed to define their projects themselves.','Promotes self-initiation and improvisation to find or define a project. - Links theory to practice','Time demanding for students and requires teachers to keep students motivated',1,5,2,1,5,3,3,5,2,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (26,'Learn by doing','A group or individuals directly start to practice on the taught subjects. This type of teaching often includes laboratory assignments, field exercises, workplace training and workshops, for example. The purpose of laboratory assignments is to familiarise the students with experimental work, various measuring methods and devices and also to illustrate the subjects covered during the course','Learning through practical activity and work creatively in natural environments and direct acting. -Introduction to research and deep learning','May require labortory resurces, time consuming for both teacher and student',1,5,3,1,2,5,1,5,5,5,2,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (27,'Roleplaying','The participants may act out relationships between persons or situations related to professions or organisations. During roleplaying, attention may be paid to attitudes, values and problem solving skills.','Seeing the world through different prismas/roles. -Builts up characters, makes people see different sides of situations in real world by simulating it','Creative and mentally courageous teachers is a prerequisite',1,2,2,3,4,3,2,2,2,5,4,3);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (28,'Games','Learning games are used to practice the studied skills in an environment that models reality, but is safe.','-Entertaining. - simulates real world and learning at the same time','May demand resources and preparation from teacher',1,2,3,1,5,4,5,2,5,5,5,4);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (29,'Creative work','Creative work aims to utilise the students’ ability to adopt new perspectives, to think of new possibilities and alternatives and to build new knowledge and analyses.','Freedom, creativity .- Triggers the best out of everyone','Infinite solutions, not a definete correct result, demanding for assessment prposes',1,2,2,1,1,5,5,2,2,5,5,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (30,'Drama Pedagogy','Drama pedagogy challenges the students to commit themselves to independent learning and learning as a group member, to come up with ideas, to solve problems and to make value choices. Learning occurs through the active actions and studying of the students.','Engage the student to communicate together. Bring compassion to the students by reole playing.','The student may not feel involved. He/She may also focus too much on the aesthetic/theatral part.',1,2,4,1,3,5,2,2,4,5,3,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (31,'Dialogue with one self','In this method, the teacher has a dialogue with a single student.','Identify student difficulty, help in building a customized learning plan.','The student needs to feel confident with the teacher. It can be time-consuming for the teacher.',3,1,2,3,3,3,5,1,2,5,3,3);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (32,'Exercises','Students solve exercises either independantly or in groups. The exercises are made so that the students can solved them with their lecture notes. Once the exercise is solved, the learned topics can be analyzed. It is a teaching approach based on experience (Theory Action Reflection)','Applying theory in real case applications. Putting the theory in action','Creating exercises so that the work is properly challenging. Proposing exercises where a variety of answers can be acceptable',1,3,2,3,1,1,5,4,3,5,2,2);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (33,'Mnemonics in teaching','Supporting memorization with keywords, sketches to connect new knowledge with acquired knowledge','Supporting memory promotes learning. Remembering is made easier when the information is meaningful.','Remembering does not mean that the students have understood fully the topic. Activating mechanically the memory of the students may also promote surface learning. To achieve a deep learning, students needs to activate their thinking instead of just their memory',1,2,2,1,1,1,5,3,4,3,3,1);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (34,'Mind map','The main topic is written down in the center and other related subjects form a tree around it.','Help understanding context of topics, it can be used as mnemonics, need analysis ofrelationships between topics. Can be employed to structure a presentation.','Time consuming to create a good mind-map. Mind-map can be very personal and could significantly differs among the students',1,2,3,1,2,1,3,3,4,4,4,1);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (35,'Collaborative learning','Students forms groups. They do not divide the task of each individual of the group but solve problem together','Employ the efforts of everyone in the group. Can reduce the feeling of isolation of students','Forming group which aims for a common goal. It can be difficult to implement when students are used to divide work. Hence, it can require an intense supervision of the teacher in order to reach collaborative learning.',1,3,2,3,3,2,3,5,4,5,5,4);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (36,'Teaching walk','Students forms groups of 2-4 and discuss about topics selected by the teacher while walking. The teacher can also take part of the discussion or just lead the walking route','Refresh the participants, good to introduce topics which does not necesseraly needs to be written down','Weather may no be on your side.Making sure the students stay on the topic. It may not be possible for large group',1,1,1,1,1,2,3,2,2,2,2,3);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (37,'Step-by-step discussion','The students answers a list of questions picked by the teachers. A new question is asked after the previous one is answered. Answer can be found by reading material or by though.','Works for various group size. Leading the students learning process by choosing beforehand the questions','Creating a good serie of questions. Questions should not be too easy so that the students should look for their answer insteedof just answering',1,2,3,1,3,1,5,3,4,3,5,1);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (38,'Symposium','Participants introduced their subjects which are then discussed by the students. Every participant is an expert which need to prepare for the subjects. One participant acts as a chairman who is responsible to follow the schedule','All participant have reached a deep learning by preparing themselves beforehand. Hence it enables fructious discussion','Requires heavy student workload. Avoiding a competition of knowledge.',1,3,2,4,2,3,3,5,3,5,4,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (39,'Seminar','Students presents their work in a seminar. They read summaries of the work done by other students','Structuring ideas and justifying their solution','Requires enough knowledge for both the presenter and the audiance. Workload of the student may be significant',1,3,2,4,2,3,3,5,3,5,3,5);
INSERT INTO methods(id,title,description,pros,cons,min_group_size,min_student_workload,min_teacher_workload,min_student_experience,min_teacher_experience,min_student_interaction,max_group_size,max_student_workload,max_teacher_workload,max_student_experience,max_teacher_experience,max_student_interaction) VALUES (40,'Interview','A pair of two students is formed where one interview the other. The interviewer takes note during the interview and later write down a report about the topic','Organizing and clarifying ideas','Good interview comes with experience. Studennts may feel unconfortable to express their though to a stranger',1,1,2,3,2,2,4,3,3,5,3,3);
