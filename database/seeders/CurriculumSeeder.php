<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            // --- IT Curriculum ---
            ['code' => 'IT1101', 'title' => 'The Contemporary World', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT1102', 'title' => 'Purposive Communication', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT1103', 'title' => 'Introduction to Computing', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT1104', 'title' => 'Computer Programming 1', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT1105', 'title' => 'Environmental Science', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT1106', 'title' => 'Physical Activities Towards Health 1', 'units' => 2, 'year' => 1, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT1107', 'title' => 'ROTC 1', 'units' => 2, 'year' => 1, 'semester' => 1, 'course' => 'IT'],

            ['code' => 'IT1201', 'title' => 'Computer Programming 2', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT1202', 'title' => 'Data Structures & Algorithms', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT1203', 'title' => 'Mathematics in the Modern World', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT1204', 'title' => 'Science, Technology & Society', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT1205', 'title' => 'Physical Activities Towards Health 2', 'units' => 2, 'year' => 1, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT1206', 'title' => 'NSTP 2', 'units' => 2, 'year' => 1, 'semester' => 2, 'course' => 'IT'],

            ['code' => 'IT2101', 'title' => 'Object-Oriented Programming', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT2102', 'title' => 'Database Management Systems', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT2103', 'title' => 'Networking 1', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT2104', 'title' => 'Human-Computer Interaction', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT2105', 'title' => 'Filipino Discipline', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT2106', 'title' => 'Physical Education 3', 'units' => 2, 'year' => 2, 'semester' => 1, 'course' => 'IT'],

            ['code' => 'IT2201', 'title' => 'Systems Analysis & Design', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT2202', 'title' => 'Networking 2', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT2203', 'title' => 'Web Development', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT2204', 'title' => 'Operating Systems', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT2205', 'title' => 'Physical Education 4', 'units' => 2, 'year' => 2, 'semester' => 2, 'course' => 'IT'],

            ['code' => 'IT3101', 'title' => 'Mobile Application Development', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT3102', 'title' => 'Systems Integration & Architecture', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT3103', 'title' => 'Software Engineering', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT3104', 'title' => 'Information Management', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT3105', 'title' => 'IT Elective 1', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'IT'],

            ['code' => 'IT3201', 'title' => 'Capstone Project 1', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT3202', 'title' => 'Network Security', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT3203', 'title' => 'IT Project Management', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'IT'],
            ['code' => 'IT3204', 'title' => 'IT Elective 2', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'IT'],

            ['code' => 'IT4101', 'title' => 'Capstone Project 2', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT4102', 'title' => 'Practicum / OJT', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT4103', 'title' => 'IT Laws & Ethics', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'IT'],
            ['code' => 'IT4104', 'title' => 'IT Elective 3', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'IT'],

            ['code' => 'IT4201', 'title' => 'On-the-Job Training', 'units' => 6, 'year' => 4, 'semester' => 2, 'course' => 'IT'],

            // --- CS Curriculum ---
            ['code' => 'CS1101', 'title' => 'The Contemporary World', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS1102', 'title' => 'Purposive Communication', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS1103', 'title' => 'Introduction to Computing', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS1104', 'title' => 'Computer Programming 1 (Fundamentals)', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS1105', 'title' => 'Calculus 1', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS1106', 'title' => 'Physical Education 1', 'units' => 2, 'year' => 1, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS1107', 'title' => 'ROTC 1', 'units' => 3, 'year' => 1, 'semester' => 1, 'course' => 'CS'],

            ['code' => 'CS1201', 'title' => 'Data Structures and Algorithms 1', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS1202', 'title' => 'Computer Programming 2 (OOP Basics)', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS1203', 'title' => 'Discrete Mathematics', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS1204', 'title' => 'Arts Appreciation', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS1205', 'title' => 'Science, Technology and Society', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS1206', 'title' => 'Great Books', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS1207', 'title' => 'Physical Education 2', 'units' => 2, 'year' => 1, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS1208', 'title' => 'ROTC 2', 'units' => 3, 'year' => 1, 'semester' => 2, 'course' => 'CS'],

            ['code' => 'CS2101', 'title' => 'Object-Oriented Programming', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS2102', 'title' => 'Database Management Systems', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS2103', 'title' => 'Computer Organization and Architecture', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS2104', 'title' => 'Probability and Statistics', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS2105', 'title' => 'IT Ethics and Society', 'units' => 3, 'year' => 2, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS2106', 'title' => 'Physical Education 3', 'units' => 2, 'year' => 2, 'semester' => 1, 'course' => 'CS'],

            ['code' => 'CS2201', 'title' => 'Networking Fundamentals', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS2202', 'title' => 'Software Engineering', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS2203', 'title' => 'Web Development 1', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS2204', 'title' => 'Information Security 1', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS2205', 'title' => 'Quantitative Methods', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS2206', 'title' => 'Platform Technologies', 'units' => 3, 'year' => 2, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS2207', 'title' => 'Physical Education 4', 'units' => 2, 'year' => 2, 'semester' => 2, 'course' => 'CS'],

            ['code' => 'CS3101', 'title' => 'Data Structures and Algorithms 2', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS3102', 'title' => 'Operating Systems', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS3103', 'title' => 'Programming Languages Theory', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS3104', 'title' => 'Computer Networks', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS3105', 'title' => 'Artificial Intelligence Basics', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS3106', 'title' => 'Integrative Programming Project', 'units' => 3, 'year' => 3, 'semester' => 1, 'course' => 'CS'],

            ['code' => 'CS3201', 'title' => 'Capstone Project 1 & Research I', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS3202', 'title' => 'Advanced Web Development', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS3203', 'title' => 'Information Security 2', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS3204', 'title' => 'Parallel & Distributed Computing', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS3205', 'title' => 'Human-Computer Interaction', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS3206', 'title' => 'Computer Graphics', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'CS'],
            ['code' => 'CS3207', 'title' => 'Philippine History & Culture', 'units' => 3, 'year' => 3, 'semester' => 2, 'course' => 'CS'],

            ['code' => 'CS4101', 'title' => 'System Administration & Maintenance', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS4102', 'title' => 'Capstone Project 2 & Research II', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS4103', 'title' => 'Cloud Computing & Web Systems', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS4104', 'title' => 'Software Project Management', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS4105', 'title' => 'Ethics & Professional Practice', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'CS'],
            ['code' => 'CS4106', 'title' => 'Reading in Philippine History', 'units' => 3, 'year' => 4, 'semester' => 1, 'course' => 'CS'],

            ['code' => 'CS4201', 'title' => 'Practicum / On-the-Job Training (486 Hours)', 'units' => 6, 'year' => 4, 'semester' => 2, 'course' => 'CS'],
        ];

        foreach ($subjects as $subjectData) {
            Subject::updateOrCreate(
                ['code' => $subjectData['code']], // Hahahanapin kung umiiral na para iwas duplicate
                $subjectData
            );
        }
    }
}