create table Subject (
	Id SERIAL PRIMARY KEY,
    Name VARCHAR(100) NOT NULL
);

create table Lector (
	Id SERIAL PRIMARY KEY,
    Name VARCHAR(100) NOT NULL
);

create table "group" (
	Id SERIAL primary key,
	Name varchar(15) not null
);

create table Student (
	Id int primary key,
	GroupId int not null references "group"(Id) on delete cascade
);

CREATE TYPE WeekType AS ENUM ('Numerator', 'Denominator', 'Both');

create table Schedule (
	Id SERIAL primary key,
	GroupId int not null references "group"(Id) on delete cascade,
	LectorId int not null references Lector(Id) on delete cascade,
	SubjectId int not null references Subject(Id) on delete cascade,
	Classroom int,
	DayOfWeek int not null check (DayOfWeek >= 0 AND DayOfWeek < 7),
	Address varchar(150),
	Week WeekType not null,
	StartTime time not null,
	EndTime time not null
);

create table Attendance (
	ScheduleId int not null references Schedule(Id) on delete cascade,
	StudentId int not null references Student(Id) on delete cascade,
	SkippedClassNumber int default 0,
	primary key (ScheduleId, StudentId)
);

insert into "group"(name) values('ПМИ-41');
insert into "group" values(2, 'ПМИ-42');
insert into "group" values(3, 'МКН-41');
insert into "group" values(4, 'ИБ-41');
insert into "group" values(5, 'КБ-41');

insert into subject values(1, 'Информационные технологии');
insert into subject values(2, 'Криптографические методы защиты информации');
insert into subject values(3, 'Техническая защита информации');
insert into subject values(4, 'Безопасность систем баз данных');
insert into subject values(5, 'Безопасность компьютерных сетей');
insert into subject values(6, 'Основы управления информационной безопасностью');
insert into subject values(7, 'Комплексная защита объектов информатизации');
insert into subject values(8, 'Сети и системы передачи информации');

insert into subject values(9, 'Вероятностные алгоритмы');
insert into subject values(10, 'Системы управления базами данных');
insert into subject values(11, 'Правоведение');
insert into subject values(12, 'Психология');
insert into subject values(13, 'Аппаратные средства вычислительной техники');
insert into subject values(14, 'Алгебраические структуры');
insert into subject values(15, 'Основы информационной безопасности');

insert into subject values(16,'Теория изображений');
insert into subject values(17, 'Компьютерная гидродинамика');
insert into subject values(18,'Методы оптимизации');
insert into subject values(19,'Комбинаторная оптимизация');
insert into subject values(20,'Теоретическая механика');
insert into subject values(21,'ПМП и ММ');
insert into subject values(22,'Физика');
insert into subject values(23,'Основы права');
insert into subject values(24,'Теория изображений');


insert into subject values(25,'ГТДС');
insert into subject values(26, 'Вычислительная алгебра');
insert into subject values(27,'Теория уравнений с запаздыванием');
insert into subject values(28,'ДГЧМ');
insert into subject values(29,'Прикладной функциональный анализ');
insert into subject values(30,'Выпуклое программирование');
insert into subject values(31,'Математическое моделирование');
insert into subject values(32,'Функциональное программирование');
insert into subject values(33,'Динамика дискретных систем');
insert into subject values(34,'ИЗВМ');
insert into subject values(35,'Динамические системы и случайные процессы');
insert into subject values(36,'Суперкомпьютерные технологии и основы ИИ');
insert into subject values(37,'Всплесковый анализ');
insert into subject values(38,'Задачи аппроксимации');
insert into subject values(39,'Визуальные системы');
insert into subject values(40,'Безопасность жизнедеятельности');



insert into lector(name) values('Власова О.В.');
insert into lector(name) values('Ухалов А.Ю.');
insert into lector(name) values('Сорокина М.Е.');
insert into lector(name) values('Очиров А.А.');
insert into lector(name) values('Бизин О.Е.');
insert into lector(name) values('Саханда А.В.');
insert into lector(name) values('Захаров А.С.');
insert into lector(name) values('Белов А.Р.');
insert into lector(name) values('Казанков С.П.');
insert into lector(name) values('Кашапов А.С.');
insert into lector(name) values('Афонин А.А.');
insert into lector(name) values('Савинов Д.А.');
insert into lector(name) values('Тимофеева Н.В.');


insert into lector(name) values('Никулина Е.В.');
insert into lector(name) values('Литвинов В.В.');
insert into lector(name) values('Климов В.С.');
insert into lector(name) values('Гринев Д.В.');
insert into lector(name) values('Алексеев В.В.');
insert into lector(name) values('Секацкая А.В.');
insert into lector(name) values('Иродова И.П.');
insert into lector(name) values('Мазалецкий Л.А.');
insert into lector(name) values('Кулев А.Г.');

insert into lector(name) values('Умнова И.В.');
insert into lector(name) values('Майорова Н.Л.');
insert into lector(name) values('Глазков Д.В.');
insert into lector(name) values('Кащенко И.С.');
insert into lector(name) values('Преображенский И.Е.');
insert into lector(name) values('Зеркалина Е.И.');
insert into lector(name) values('Глызин Д.С.');
insert into lector(name) values('Смирнова М.В.');

insert into schedule values(1, 4, 1, 4, 403, 0, null, 'Both', '09:00', '10:35');
insert into schedule values(2, 4, 2, 1, 402, 0, null, 'Both', '10:45', '12:20');
insert into schedule values(3, 4, 3, 2, 319, 0, null, 'Both', '13:20', '14:55');

insert into schedule values(4, 4, 4, 3, 432, 2, null, 'Both', '09:00', '10:35');
insert into schedule values(5, 4, 4, 3, 432, 2, null, 'Both', '10:45', '12:20');

insert into schedule values(6, 4, 1, 4, 402, 3, null, 'Numerator', '09:00', '10:35');
insert into schedule values(7, 4, 3, 2, 319, 3, null, 'Both', '10:45', '12:20');
insert into schedule values(8, 4, 7, 8, 409, 3, null, 'Denominator', '13:20', '14:55');
insert into schedule values(9, 4, 7, 8, 409, 3, null, 'Denominator', '15:05', '16:40');

insert into schedule values(10, 4, 5, 5, 225, 4, '1 корпус', 'Both', '09:00', '10:35');
insert into schedule values(11, 4, 5, 5, 225, 4, '1 корпус', 'Both', '10:45', '12:20');

insert into schedule values(12, 4, 6, 6, null, 5, 'online', 'Both', '09:00', '10:35');
insert into schedule values(13, 4, 6, 7, null, 5, 'online', 'Both', '10:45', '12:20');
insert into schedule values(14, 4, 6, 6, null, 5, 'online', 'Both', '13:20', '14:55');
insert into schedule values(15, 4, 6, 7, null, 5, 'online', 'Both', '15:05', '16:40');

insert into schedule values(16, 5, 17, 9, 321, 0, null, 'Both', '10:45', '12:20');
insert into schedule values(17, 5, 8, 2, 401, 0, null, 'Both', '13:20', '14:55');
insert into schedule values(18, 5, 8, 2, 401, 0, null, 'Both', '15:05', '16:40');

insert into schedule values(19, 5, 1, 10, 408, 2, null, 'Numerator', '09:00', '10:35');
insert into schedule values(20, 5, 9, 11, 317, 2, null, 'Both', '10:45', '12:20');
insert into schedule values(21, 5, 9, 11, 317, 2, null, 'Denominator', '09:00', '10:35');

insert into schedule values(22, 5, 17, 9, 321, 3, null, 'Numerator', '09:00', '10:35');
insert into schedule values(23, 5, 10, 12, 417, 3, null, 'Numerator', '10:45', '12:20');
insert into schedule values(24, 5, 7, 8, 409, 3, null, 'Numerator', '13:20', '14:55');
insert into schedule values(25, 5, 7, 8, 409, 3, null, 'Numerator', '15:05', '16:40');
insert into schedule values(26, 5, 10, 12, 412, 3, null, 'Denominator', '09:00', '10:35');
insert into schedule values(27, 5, 7, 8, 409, 3, null, 'Denominator', '10:45', '12:20');

insert into schedule values(28, 5, 11, 13, 107, 4, '1 корпус', 'Both', '09:00', '10:35');
insert into schedule values(29, 5, 11, 13, 107,4, '1 корпус', 'Both', '10:45', '12:20');
insert into schedule values(30, 5, 1, 10, 412, 4, null, 'Both', '13:20', '14:55');
insert into schedule values(31, 5, 13, 14, 412, 4, null, 'Both', '15:05', '16:40');

insert into schedule values(32, 5, 12, 4, 412, 5, null, 'Both', '09:00', '10:35');
insert into schedule values(33, 5, 12, 4, 412,5, null, 'Both', '10:45', '12:20');
insert into schedule values(34, 5, 6, 15, null, 5, 'online', 'Both', '16:50', '18:25');

insert into schedule values(35, 3, 15, 17, 407, 1, null, 'Numerator', '09:00', '10:35');
insert into schedule values(36, 3, 17, 19, 317, 1, null, 'Denominator', '09:00', '10:35');
insert into schedule values(37, 3, 14, 4, 407,1, null, 'Numerator', '10:45', '12:20');
insert into schedule values(38, 3, 15, 16, 407,1, null, 'Denominator', '10:45', '12:20');
insert into schedule values(39, 3, 16, 18, 409, 1, null, 'Both', '13:20', '14:55');
insert into schedule values(40, 3, 16, 18, 409, 1, null, 'Both', '15:05', '16:40');

insert into schedule values(41, 3, 17, 19, 422, 2, null, 'Both', '09:00', '10:35');
insert into schedule values(42, 3, 2, 1, 419,2, null, 'Numerator', '10:45', '12:20');
insert into schedule values(43, 3, 18, 36, 417,2, null, 'Denominator', '10:45', '12:20');

insert into schedule values(44, 3, 10, 12, 417, 3, null, 'Both', '09:00', '10:35');
insert into schedule values(45, 3, 19, 20, 426,3, null, 'Both', '10:45', '12:20');
insert into schedule values(46, 3, 19, 20, 426, 3, null, 'Both', '13:20', '14:55');
insert into schedule values(47, 3, 19, 21, 419, 3, null, 'Both', '15:05', '16:40');

insert into schedule values(48, 3, 17, 22, 401, 4, null, 'Denominator', '10:45', '12:20');
insert into schedule values(49, 3, 13, 26, 320, 4, null, 'Both', '13:20', '14:55');
insert into schedule values(50, 3, 21, 22, 427, 4, null, 'Numerator', '15:05', '16:40');
insert into schedule values(51, 3, 16, 18, 409, 4, null, 'Denominator', '15:05', '16:40');

insert into schedule values(52, 3, 22, 23, 5, 5, 'юридический факультет', 'Both', '09:00', '10:35');

insert into schedule values(53, 1, 19, 25, 414,0, null, 'Numerator', '10:45', '12:20');
insert into schedule values(54, 1, 15, 34, 427,0, null, 'Denominator', '10:45', '12:20');
insert into schedule values(55, 1, 19, 25, 414, 0, null, 'Numerator', '13:20', '14:55');
insert into schedule values(56, 1, 15, 34, 427, 0, null, 'Denominator', '13:20', '14:55');
insert into schedule values(57, 1, 19, 25, 414, 0, null, 'Numerator', '15:05', '16:40');
insert into schedule values(58, 1, 15, 34, 427, 0, null, 'Denominator', '15:05', '16:40');

insert into schedule values(59, 1, 25, 26, 321, 1, null, 'Both', '09:00', '10:35');
insert into schedule values(60, 1, 20, 27, 417,1, null, 'Numerator', '10:45', '12:20');
insert into schedule values(61, 1, 16, 28, 409,1, null, 'Denominator', '10:45', '12:20');
insert into schedule values(62, 1, 24, 18, 427, 1, null, 'Numerator', '13:20', '14:55');
insert into schedule values(63, 1, 16, 25, 417, 1, null, 'Denominator', '13:20', '14:55');
insert into schedule values(64, 1, 24, 18, 427, 1, null, 'Numerator', '15:05', '16:40');
insert into schedule values(65, 1, 25, 26, 321, 1, null, 'Numerator', '16:50', '18:25');

insert into schedule values(66, 1, 27, 30, 427, 2, null, 'Numerator', '09:00', '10:35');
insert into schedule values(67, 1, 26, 31, 407, 2, null, 'Denominator', '09:00', '10:35');
insert into schedule values(68, 1, 27, 30, 427,2, null, 'Numerator', '10:45', '12:20');
insert into schedule values(69, 1, 26, 31, 407,2, null, 'Denominator', '10:45', '12:20');
insert into schedule values(70, 1, 30, 32, 403, 2, null, 'Numerator', '13:20', '14:55');
insert into schedule values(71, 1, 16, 35, 417, 2, null, 'Denominator', '13:20', '14:55');
insert into schedule values(72, 1, 16, 35, 417, 2, null, 'Denominator', '15:05', '16:40');

insert into schedule values(73, 1, 28, 40, 411, 3, null, 'Numerator', '09:00', '10:35');
insert into schedule values(74, 1, 10, 12, 412, 3, null, 'Denominator', '09:00', '10:35');
insert into schedule values(75, 1, 28, 40, 411, 3, null, 'Numerator', '10:45', '12:20');
insert into schedule values(76, 1, 10, 12, 417, 3, null, 'Denominator', '10:45', '12:20');
insert into schedule values(77, 1, 29, 36, 403, 3, null, 'Both', '13:20', '14:55');
insert into schedule values(78, 1, 29, 36, 418, 3, null, 'Both', '15:05', '16:40');
insert into schedule values(79, 1, 29, 36, 403, 3, null, 'Denominator', '16:50', '18:25');

insert into schedule values(80, 1, 27, 37, 426, 4, null, 'Both', '10:45', '12:20');
insert into schedule values(81, 1, 27, 37, 426, 4, null, 'Numerator', '13:20', '14:55');
insert into schedule values(82, 1, 13, 38, 417, 4, null, 'Denominator', '13:20', '14:55');

insert into schedule values(83, 1, 22, 23, 5, 5, 'юридический факультет', 'Both', '09:00', '10:35');
insert into schedule values(84, 1, 30, 39, 402, 3, null, 'Denominator', '10:45', '12:20');
insert into schedule values(85, 1, 30, 39, 402, 3, null, 'Denominator', '13:20', '14:55');
insert into schedule values(86, 1, 30, 39, 402, 3, null, 'Denominator', '15:05', '16:40');


insert into schedule values(87, 2, 19, 25, 414,0, null, 'Numerator', '10:45', '12:20');
insert into schedule values(88, 2, 15, 34, 427,0, null, 'Denominator', '10:45', '12:20');
insert into schedule values(89, 2, 19, 25, 414, 0, null, 'Numerator', '13:20', '14:55');
insert into schedule values(90, 2, 15, 34, 427, 0, null, 'Denominator', '13:20', '14:55');
insert into schedule values(91, 2, 19, 25, 414, 0, null, 'Numerator', '15:05', '16:40');
insert into schedule values(92, 2, 15, 34, 427, 0, null, 'Denominator', '15:05', '16:40');

insert into schedule values(93, 2, 25, 26, 321, 1, null, 'Both', '09:00', '10:35');
insert into schedule values(94, 2, 20, 27, 417,1, null, 'Numerator', '10:45', '12:20');
insert into schedule values(95, 2, 16, 28, 409,1, null, 'Denominator', '10:45', '12:20');
insert into schedule values(96, 2, 24, 18, 427, 1, null, 'Numerator', '13:20', '14:55');
insert into schedule values(97, 2, 16, 25, 417, 1, null, 'Denominator', '13:20', '14:55');
insert into schedule values(98, 2, 24, 18, 427, 1, null, 'Numerator', '15:05', '16:40');
insert into schedule values(99, 2, 25, 26, 321, 1, null, 'Numerator', '16:50', '18:25');

insert into schedule values(100, 2, 27, 30, 427, 2, null, 'Numerator', '09:00', '10:35');
insert into schedule values(101, 2, 26, 31, 407, 2, null, 'Denominator', '09:00', '10:35');
insert into schedule values(102, 2, 27, 30, 427,2, null, 'Numerator', '10:45', '12:20');
insert into schedule values(121, 2, 26, 31, 407,2, null, 'Denominator', '10:45', '12:20');
insert into schedule values(103, 2, 30, 32, 403, 2, null, 'Numerator', '13:20', '14:55');
insert into schedule values(105, 2, 16, 35, 417, 2, null, 'Denominator', '13:20', '14:55');
insert into schedule values(106, 2, 16, 35, 417, 2, null, 'Denominator', '15:05', '16:40');

insert into schedule values(107, 2, 28, 40, 411, 3, null, 'Numerator', '09:00', '10:35');
insert into schedule values(108, 2, 10, 12, 412, 3, null, 'Denominator', '09:00', '10:35');
insert into schedule values(109, 2, 29, 36, 403, 3, null, 'Both', '10:45', '12:20');
insert into schedule values(110, 2, 28, 40, 411, 3, null, 'Numerator', '13:20', '14:55');
insert into schedule values(111, 2, 10, 12, 417, 3, null, 'Denominator', '13:20', '14:55');
insert into schedule values(112, 2, 29, 36, 418, 3, null, 'Both', '15:05', '16:40');
insert into schedule values(113, 2, 29, 36, 403, 3, null, 'Numerator', '16:50', '18:25');

insert into schedule values(114, 2, 27, 37, 426, 4, null, 'Both', '10:45', '12:20');
insert into schedule values(115, 2, 27, 37, 426, 4, null, 'Numerator', '13:20', '14:55');
insert into schedule values(116, 2, 13, 38, 417, 4, null, 'Denominator', '13:20', '14:55');

insert into schedule values(117, 2, 22, 23, 5, 5, 'юридический факультет', 'Both', '09:00', '10:35');
insert into schedule values(118, 2, 30, 39, 402, 3, null, 'Denominator', '10:45', '12:20');
insert into schedule values(119, 2, 30, 39, 402, 3, null, 'Denominator', '13:20', '14:55');
insert into schedule values(120, 2, 30, 39, 402, 3, null, 'Denominator', '15:05', '16:40');
