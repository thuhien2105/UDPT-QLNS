class Models:
    def __init__(self):
        pass
    def to_dict(self):
        return {key: value for key, value in self.__dict__.items() if not key.startswith('_')}
