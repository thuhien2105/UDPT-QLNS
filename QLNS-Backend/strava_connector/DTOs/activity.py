from . import models
from typing import Optional, List, Dict


class Activity(models.Models):
    def __init__(self, id: int, resource_state: int, external_id: Optional[str], upload_id: Optional[str],
                 athlete: Dict[str, int], name: str, distance: float, moving_time: int, elapsed_time: int,
                 total_elevation_gain: float, type: str, sport_type: str, start_date: str, start_date_local: str,
                 timezone: str, utc_offset: int, achievement_count: int, kudos_count: int, comment_count: int,
                 athlete_count: int, photo_count: int, map: Dict[str, Optional[str]], trainer: bool, commute: bool,
                 manual: bool, private: bool, flagged: bool, gear_id: str, from_accepted_tag: Optional[str],
                 average_speed: float, max_speed: float, device_watts: bool, has_heartrate: bool, pr_count: int,
                 total_photo_count: int, has_kudoed: bool, workout_type: Optional[str], description: Optional[str],
                 calories: int, segment_efforts: List[Dict]):
        self.id = id
        self.resource_state = resource_state
        self.external_id = external_id
        self.upload_id = upload_id
        self.athlete = athlete
        self.name = name
        self.distance = distance
        self.moving_time = moving_time
        self.elapsed_time = elapsed_time
        self.total_elevation_gain = total_elevation_gain
        self.type = type
        self.sport_type = sport_type
        self.start_date = start_date
        self.start_date_local = start_date_local
        self.timezone = timezone
        self.utc_offset = utc_offset
        self.achievement_count = achievement_count
        self.kudos_count = kudos_count
        self.comment_count = comment_count
        self.athlete_count = athlete_count
        self.photo_count = photo_count
        self.map = map
        self.trainer = trainer
        self.commute = commute
        self.manual = manual
        self.private = private
        self.flagged = flagged
        self.gear_id = gear_id
        self.from_accepted_tag = from_accepted_tag
        self.average_speed = average_speed
        self.max_speed = max_speed
        self.device_watts = device_watts
        self.has_heartrate = has_heartrate
        self.pr_count = pr_count
        self.total_photo_count = total_photo_count
        self.has_kudoed = has_kudoed
        self.workout_type = workout_type
        self.description = description
        self.calories = calories
        self.segment_efforts = segment_efforts
